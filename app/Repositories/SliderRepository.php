<?php

namespace App\Repositories;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\DB;
use Image;

class SliderRepository
{
    public function get($whereScope = NULL)
    {
        $q = Slider::select('*');
        if ($whereScope) {
            foreach ($whereScope as $key => $scope) {
                if ($scope[1] == 'IN') {
                    unset($whereScope[$key]);
                    $q->whereIn($scope[0], $scope[2]);
                }
            }
            $q->where($whereScope);
        }
        $data = $q->get();

        return $data;
    }

    public function first($slug, $whereScope = NULL)
    {
        $q = Slider::whereSlug($slug);
        if ($whereScope) {
            foreach ($whereScope as $key => $scope) {
                if ($scope[1] == 'IN') {
                    unset($whereScope[$key]);
                    $q->whereIn($scope[0], $scope[2]);
                }
            }
            $q->where($whereScope);
        }
        $data = $q->first();

        return $data;
    }

    public function store(Request $request)
    {
        $status = false;
        $message = 'Gagal tambah slider';

        try {
            DB::beginTransaction();

            $store = new Slider();

            // upload slider
            $destinationPath = 'uploads/slider'; // upload path
            $destinationPathThumbnail = 'uploads/slider/thumbnail'; // thumbnail upload path

            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 755, true);
            }
            if (!file_exists($destinationPathThumbnail)) {
                File::makeDirectory($destinationPathThumbnail, 755, true);
            }

            $gambar = $request->file('gambar');
            $extension = $gambar->getClientOriginalExtension();
            $filename = Str::slug($request->judul) . '.' . $extension;
            $gambarFile = Image::make($gambar->getRealPath());
            $uploadThumb = $gambarFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail . '/' . $filename);
            $upload = $gambarFile->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);

            if ($uploadThumb && $upload) {
                $store->gambar = $filename;
            } else {
                $message = 'Gagal upload slider';

                return array(
                    'status' => $status,
                    'message' => $message
                );
            }

            $store->slug = $request->slug;
            $store->judul = $request->judul;
            $store->deskripsi = $request->deskripsi;
            $store->is_judul_show = $request->is_judul_show == 'on' ? true : false;
            $store->is_deskripsi_show = $request->is_deskripsi_show == 'on' ? true : false;
            $store->is_active = $request->is_active == 'on' ? true : false;
            $store->save();

            DB::commit();

            $status = true;
            $message = 'Berhasil tambah slider';
        } catch (\Throwable $th) {
            DB::rollBack();
            $message = $th->getMessage();
        }

        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function update(Request $request, Slider $slider)
    {
        $status = false;
        $message = 'Gagal ubah slider';

        try {
            DB::beginTransaction();

            $update = $slider;

            if ($request->file('gambar')) {
                // upload slider
                $destinationPath = 'uploads/slider'; // upload path
                $destinationPathThumbnail = 'uploads/slider/thumbnail'; // thumbnail upload path

                // hapus thumbnail lama
                if (File::exists(public_path($destinationPathThumbnail . $slider->gambarInfografik->gambar))) {
                    File::delete(public_path($destinationPathThumbnail . $slider->gambarInfografik->gambar));
                }

                // hapus gambar lama
                if (File::exists(public_path($destinationPath . $slider->gambarInfografik->gambar))) {
                    File::delete(public_path($destinationPath . $slider->gambarInfografik->gambar));
                }

                $gambar = $request->file('gambar');
                $extension = $gambar->getClientOriginalExtension();
                $filename = Str::slug($request->judul) . '.' . $extension;
                $gambarFile = Image::make($gambar->getRealPath());
                $uploadThumb = $gambarFile->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail . '/' . $filename);
                $upload = $gambarFile->resize(512, 512, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $filename);

                if ($uploadThumb && $upload) {
                    $update->gambar = $filename;
                } else {
                    $message = 'Gagal upload gambar';

                    return array(
                        'status' => $status,
                        'message' => $message
                    );
                }
            }

            $update->slug = $request->slug;
            $update->judul = $request->judul;
            $update->deskripsi = $request->deskripsi;
            $update->is_judul_show = $request->is_judul_show == 'on' ? true : false;
            $update->is_deskripsi_show = $request->is_deskripsi_show == 'on' ? true : false;
            $update->is_active = $request->is_active == 'on' ? true : false;
            $update->save();

            DB::commit();

            $status = true;
            $message = 'Berhasil ubah slider';
        } catch (\Throwable $th) {
            DB::rollBack();
            $message = $th->getMessage();
        }

        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function delete(Slider $slider)
    {
        $status = false;
        $message = 'Gagal hapus slider';

        // hapus gambar lama
        $destinationPath = 'uploads/slider/'; // upload path
        $destinationPathThumbnail = 'uploads/infografik/thumbnail'; // thumbnail upload path

        if (File::exists(public_path($destinationPath . $slider->gambar))) {
            if (File::delete(public_path($destinationPath . $slider->gambar))) {
                if ($slider->delete()) {
                    $status = true;
                    $message = 'Berhasil hapus slider';
                }
            }
        }

        if (File::exists(public_path($destinationPathThumbnail . $slider->gambarInfografik->gambar))) {
            if (File::delete(public_path($destinationPathThumbnail . $slider->gambarInfografik->gambar))) {
                if ($slider->delete()) {
                    $status = true;
                    $message = 'Berhasil hapus slider';
                }
            }
        }

        return array(
            'status' => $status,
            'message' => $message,
        );
    }
}
