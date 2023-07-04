<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function all()
    {
        $q = User::select('*');
        if (auth()->user()->hasRole('masteradmin')) {
            $exclude = [
                'masteradmin'
            ];
            $q->whereNotIn('username', $exclude);
        } else {
            $exclude = [
                'superadmin',
                'masteradmin'
            ];
            $q->whereNotIn('username', $exclude);
        }
        $data = $q->orderBy('id', 'DESC')->get();

        return $data;
    }

    public function roles()
    {
        if (auth()->user()->hasRole('masteradmin')) {
            $exclude = [
                'masteradmin'
            ];
        } else {
            $exclude = [
                'superadmin',
                'masteradmin'
            ];
        }

        $data = Role::whereNotIn('name', $exclude)->pluck('name', 'name')->all();

        return $data;
    }

    public function store($request)
    {
        $status = false;
        $message = 'Gagal tambah user';

        // tambah user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->email_verified_at = now();
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            $user->assignRole($request->roles);
            $status = true;
            $message = 'Berhasil tambah user';
        }

        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function update($request, $id)
    {
        // update user
        $failedTransaction = '';
        try {
            DB::beginTransaction();

            $user = User::getBy('id', $id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update Peran
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->roles);

            DB::commit();
            return array(
                'status' => true,
                'message' => 'Berhasil ubah user',
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            $failedTransaction = ', ' . $th->getMessage();
        }

        return array(
            'status' => false,
            'message' => 'Gagal ubah user' . $failedTransaction,
        );
    }

    public function delete($id)
    {
        $status = false;
        $message = 'Gagal hapus user';
        
        $data = User::getBy('id', $id);
            if ($data->delete()) {
                $status = true;
                $message = 'Berhasil hapus user';
            }

        return array(
            'status' => $status,
            'message' => $message,
        );
    }
}
