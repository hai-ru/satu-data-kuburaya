<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Repositories\PermissionRepository;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    private $permissionRepo;

    function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;

        $this->middleware('permission:permissions-browse', ['only' => ['index']]);
        $this->middleware('permission:permissions-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permissions-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:permissions-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['pageTitle'] = 'Daftar Hak Akses';
        $data['permissions'] = $this->permissionRepo->all();

        return view('manajemen.hak-akses.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Tambah Hak Akses';
        $data['options'] = ['browse', 'read', 'edit', 'add', 'delete'];

        return view('manajemen.hak-akses.create', $data);
    }

    public function store(PermissionStoreRequest $request)
    {
        $data = $this->permissionRepo->store($request);
        if ($data['status']) {
            Alert::success('Hak Akses', $data['message'])->persistent('Dismiss');
            return redirect()->route('permissions.index');
        }

        Alert::error('Hak Akses', $data['message'] ?? 'Gagal tambah hak akses')->persistent('Dismiss');
        return redirect()->back()->withInput();
    }

    public function edit(Permission $permission)
    {
        $data['pageTitle'] = 'Ubah Hak Akses';
        $data['permission'] = $permission;

        return view('manajemen.hak-akses.edit', $data);
    }

    public function update(PermissionUpdateRequest $request, $id)
    {
        $data = $this->permissionRepo->update($request, $id);

        if ($data) {
            Alert::success('Hak Akses', 'Berhasil ubah hak akses')->persistent('Dismiss');
            return redirect()->route('permissions.index');
        }

        Alert::error('Hak Akses', 'Gagal ubah hak akses')->persistent('Dismiss');
        return redirect()->back()->withInput();
    }

    public function destroy($id)
    {
        $data = $this->permissionRepo->delete($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus hak akses',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus hak akses',
            ]);
        }
    }
}
