<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    public function all()
    {
        $q = Role::select('*');
        if (auth()->user()->hasRole('masteradmin')) {
            $exclude = [
                'masteradmin'
            ];
            $q->whereNotIn('name', $exclude);
        } else if (auth()->user()->hasRole('superadmin')) {
            $exclude = [
                'masteradmin',
                'superadmin'
            ];
            $q->whereNotIn('name', $exclude);
        }
        $data = $q->get();

        return $data;
    }

    public function store($request)
    {
        $status = false;
        $message = 'Gagal tambah data peran';

        // tambah peran
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        if ($role) {
            $status = true;
            $message = 'Berhasil tambah data peran';
        }

        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function update($request, $id)
    {
        $status = false;
        $message = 'Gagal ubah peran';

        // ubah peran
        $role = Role::getBy('id', $id);
        $role->name = $request->name;
        if ($role->save()) {
            $role->syncPermissions($request->permissions);
            $status = true;
            $message = 'Berhasil ubah peran';
        }

        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function delete($id)
    {
        // hapus peran
        $data = Role::getBy('id', $id);
        return $data->delete();
    }
}
