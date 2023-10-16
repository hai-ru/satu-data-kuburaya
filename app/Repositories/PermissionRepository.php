<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionRepository
{
    public function all()
    {
        $exclude = [
            'permissions-browse',
            'permissions-read',
            'permissions-edit',
            'permissions-add',
            'permissions-delete',
        ];

        $q = Permission::orderBy('created_at', 'DESC');
        // jika peran bukan master admin
        if (!auth()->user()->hasRole('masteradmin')) {
            $q->whereNotIn('name', $exclude);
        }
        $data = $q->orderBy('created_at', 'DESC')->get();

        return $data;
    }

    public function store($request)
    {
        $failedTransaction = '';
        try {
            DB::beginTransaction();

            // tambah hak akses
            $permission = new Permission();
            $permission->group = $request->group;

            if ($request->has('options')) {
                foreach ($request->options as $option) {
                    $name = Str::slug($request->name, '-') . '-' . $option;
                    if (Permission::getBy('name', $name)) {
                        return array(
                            'status' => false,
                            'message' => 'Gagal tambah hak akses, hak akses "'.$name.'" sudah ada',
                        );
                    } else {
                        $permission->name = $name;
                        $permission->save();

                        // beri hak akses ke peran superadmin dan masteradmin
                        $superadmin = Role::getBy('name', 'superadmin');
                        $superadmin->givePermissionTo($name);
                        $masteradmin = Role::getBy('name', 'masteradmin');
                        $masteradmin->givePermissionTo($name);
                    }
                }
            } else {
                $name = Str::slug($request->name, '-');
                if (Permission::getBy('name', $name)) {
                    return array(
                        'status' => false,
                        'message' => 'Gagal tambah hak akses, hak akses "'.$name.'" sudah ada',
                    );
                } else {
                    $permission->name = $name;
                    $permission->save();

                    // beri hak akses ke peran superadmin dan masteradmin
                    $superadmin = Role::getBy('name', 'superadmin');
                    $superadmin->givePermissionTo($name);
                    $masteradmin = Role::getBy('name', 'masteradmin');
                    $masteradmin->givePermissionTo($name);
                }
            }

            DB::commit();
            return array(
                'status' => true,
                'message' => 'Berhasil tambah hak akses',
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            $failedTransaction = ', '.$th->getMessage();
        }

        return array(
            'status' => false,
            'message' => 'Gagal tambah hak akses'.$failedTransaction,
        );
    }

    public function update($request, $id)
    {
        $status = false;
        $message = 'Gagal ubah hak akses';

        // ubah hak akses
        $name = Str::slug($request->name, '-');

        $data = Permission::getBy('id', $id);
        $data->name = $name;
        $data->group = $request->group;

        if ($data->save()) {
            $status = true;
            $message = 'Berhasil ubah hak akses';
        }

        return array(
            'status' => $status,
            'message' => $message,
        );
    }

    public function delete($id)
    {
        // hapus hak akses
        $data = Permission::getBy('id', $id);
        return $data->delete();
    }
}
