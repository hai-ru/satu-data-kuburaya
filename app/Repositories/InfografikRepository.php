<?php

namespace App\Repositories;

use App\Models\Infografik;
use App\Models\InfografikGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use File;
use Image;

class InfografikRepository
{
    public function get($whereScope = NULL, $paginate = null, $orderBy = ['created_at', 'DESC'])
    {
        $q = Infografik::select('*');
        if ($whereScope) {
            foreach ($whereScope as $key => $scope) {
                if ($scope[1] == 'IN') {
                    unset($whereScope[$key]);
                    $q->whereIn($scope[0], $scope[2]);
                }
            }
            $q->where($whereScope);
        }
        if ($orderBy) {
            $q->orderBy($orderBy[0], $orderBy[1]);
        }

        $data = $paginate ? $q->paginate($paginate) : $q->get();

        return $data;
    }

    public function first($slug, $whereScope = NULL)
    {
        $q = Infografik::whereSlug($slug);
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
        $message = 'Gagal tambah infografik';

        try {
            DB::beginTransaction();

            $store = new Infografik();
            $store->judul = $request->judul;
            $store->slug = $request->slug;
            $store->link = $request->link;
            $store->tipe = $request->tipe;
            $store->group_id = $request->group_id;
            $store->ditambah_oleh = auth()->user()->id;
            $store->deskripsi = $request->deskripsi;
            
            if($request->has('pdf')){
                $filename = $request->pdf->store('/public/report');
                $store->pdf = $filename;
            }

            $store->save();

            if($request->has("gambar")){
                $upload = new InfografikGambar();
                $upload->infografik_id = $store->id;
    
                // upload infografik
                $destinationPath = 'uploads/infografik'; // upload path
                $destinationPathThumbnail = 'uploads/infografik/thumbnail'; // thumbnail upload path
    
                $gambar = $request->file('gambar');
                $extension = $gambar->getClientOriginalExtension();
                $filename = Str::slug($request->judul) . '.' . $extension;
                $gambarFile = Image::make($gambar->getRealPath());
                $uploadThumb = $gambarFile->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail . '/' . $filename);
                $uploadGambar = $gambarFile->resize(512, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $filename);
                if ($uploadThumb && $uploadGambar) {
                    $upload->gambar = $filename;
                } else {
                    $message = 'Gagal upload gambar';
    
                    return array(
                        'status' => $status,
                        'message' => $message
                    );
                }
    
                $upload->save();
            }

            DB::commit();

            $status = true;
            $message = 'Berhasil tambah infografik';
        } catch (\Throwable $th) {
            DB::rollBack();
            $message = $th->getMessage();
        }

        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function update(Request $request, Infografik $infografik)
    {
        $status = false;
        $message = 'Gagal ubah infografik';

        try {
            DB::beginTransaction();

            $update = $infografik;
            $store->judul = $request->judul;
            $store->slug = $request->slug;
            $store->link = $request->link;
            $store->tipe = $request->tipe;
            $store->group_id = $request->group_id;
            $update->deskripsi = $request->deskripsi;
            $update->diubah_oleh = auth()->user()->id;

            // DD($request->all());
            if ($request->file('gambar')) {
                $upload = InfografikGambar::whereInfografikId($infografik->id)->first();
                if(empty($upload)) {
                    $upload = new InfografikGambar();
                    $upload->infografik_id = $update->id;
                }

                // upload infografik
                $destinationPath = 'uploads/infografik'; // upload path
                $destinationPathThumbnail = 'uploads/infografik/thumbnail'; // thumbnail upload path

                // hapus thumbnail lama
                if (File::exists(public_path($destinationPathThumbnail . $infografik->gambarInfografik?->gambar))) {
                    File::delete(public_path($destinationPathThumbnail . $infografik->gambarInfografik?->gambar));
                }

                // hapus gambar lama
                if (File::exists(public_path($destinationPath . $infografik->gambarInfografik?->gambar))) {
                    File::delete(public_path($destinationPath . $infografik->gambarInfografik?->gambar));
                }

                $gambar = $request->file('gambar');
                $extension = $gambar->getClientOriginalExtension();
                $filename = Str::slug($request->judul) . '.' . $extension;
                $gambarFile = Image::make($gambar->getRealPath());
                $gambarFile->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail . '/' . $filename);
                $gambarFile->resize(512, 512, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $filename);

                $upload->gambar = $filename;
                $upload->save();
            }

            if($request->has('pdf')){
                if($update->pdf){
                    $path_checking = storage_path('app/public/'.$update->pdf);
                    if(File::exists($path_checking)) File::delete($path_checking);
                }
                $filename = $request->pdf->store('/public/report');
                $filename = str_replace('public','',$filename);
                $update->pdf = $filename;
            }

            $update->save();
            DB::commit();

            $status = true;
            $message = 'Berhasil ubah infografik';
        } catch (\Throwable $th) {
            DB::rollBack();
            $message = $th->getMessage();
        }

        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function delete(Infografik $infografik)
    {
        $status = false;
        $message = 'Gagal hapus infografik';

        // hapus gambar lama
        $destinationPath = 'uploads/infografik'; // upload path
        $destinationPathThumbnail = 'uploads/infografik/thumbnail'; // thumbnail upload path

        if (File::exists(public_path($destinationPath . $infografik->gambarInfografik->gambar))) {
            if (File::delete(public_path($destinationPath . $infografik->gambarInfografik->gambar))) {
                if ($infografik->delete()) {
                    $status = true;
                    $message = 'Berhasil hapus infografik';
                }
            }
        }
        if (File::exists(public_path($destinationPathThumbnail . $infografik->gambarInfografik->gambar))) {
            if (File::delete(public_path($destinationPathThumbnail . $infografik->gambarInfografik->gambar))) {
                if ($infografik->delete()) {
                    $status = true;
                    $message = 'Berhasil hapus infografik';
                }
            }
        }

        return array(
            'status' => $status,
            'message' => $message,
        );
    }
}
