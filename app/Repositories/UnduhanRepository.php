<?php

namespace App\Repositories;

use App\Models\Unduhan;
use Illuminate\Http\Request;

class UnduhanRepository
{
    public function get($whereScope = NULL)
    {
        $q = Unduhan::select('*');
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
        $q = Unduhan::whereSlug($slug);
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
        $message = 'Gagal tambah unduhan';

        $store = new Unduhan();
        $store->nama = $request->nama;
        $store->slug = time();
        $store->email = $request->email;
        $store->alasan_pemanfaatan = $request->alasan_pemanfaatan;
        $store->resource_id = $request->resource_id;
        if ($store->save()) {
            $status = true;
            $message = 'Berhasil tambah unduhan';
        }

        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function update(Request $request, Unduhan $unduhan)
    {
        $status = false;
        $message = 'Gagal ubah unduhan';

        $update = $unduhan;
        $update->nama = $request->nama;
        $update->email = $request->email;
        $update->alasan_pemanfaatan = $request->alasan_pemanfaatan;
        $update->resource_id = $request->resource_id;
        if ($update->save()) {
            $status = true;
            $message = 'Berhasil tambah unduhan';
        }

        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function delete(Unduhan $unduhan)
    {
        $status = false;
        $message = 'Gagal hapus unduhan';

        if ($unduhan->delete()) {
            $status = true;
            $message = 'Berhasil hapus unduhan';
        }

        return array(
            'status' => $status,
            'message' => $message,
        );
    }
}
