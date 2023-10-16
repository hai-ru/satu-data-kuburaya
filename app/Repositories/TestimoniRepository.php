<?php

namespace App\Repositories;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniRepository
{
    public function get($whereScope = NULL, $selectParam = '*')
    {
        $q = Testimoni::select($selectParam);
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

    public function store(Request $request)
    {
        $status = false;
        $message = 'Gagal tambah testimoni';

        $store = new Testimoni();
        $store->nama = $request->nama;
        $store->slug = time();
        $store->email = $request->email;
        $store->testimoni = $request->testimoni;
        $store->rating = $request->rating;
        $store->is_show = $request->is_show == 'on' ? true : false;
        if ($store->save()) {
            $status = true;
            $message = 'Berhasil tambah testimoni';
        }

        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $status = false;
        $message = 'Gagal ubah testimoni';

        $update = $testimoni;
        $update->nama = $request->nama;
        $update->email = $request->email;
        $update->testimoni = $request->testimoni;
        $update->rating = $request->rating;
        $update->is_show = $request->is_show == 'on' ? true : false;
        if ($update->save()) {
            $status = true;
            $message = 'Berhasil tambah testimoni';
        }

        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function updateStatus($id)
    {
        $data = Testimoni::whereId($id)->first();
        $status = $data->is_show;
        $data->is_show = !$status;

        return $data->save();
    }

    public function delete(Testimoni $testimoni)
    {
        $status = false;
        $message = 'Gagal hapus testimoni';

        if ($testimoni->delete()) {
            $status = true;
            $message = 'Berhasil hapus testimoni';
        }

        return array(
            'status' => $status,
            'message' => $message,
        );
    }
}
