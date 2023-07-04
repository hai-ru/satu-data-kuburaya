<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Role;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    private $roleRepo;
    private $permissionRepo;

    function __construct(
        RoleRepository $roleRepo,
        PermissionRepository $permissionRepo
    ) {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;

        $this->middleware('permission:roles-browse', ['only' => ['index']]);
        $this->middleware('permission:roles-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:roles-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:roles-delete', ['only' => ['destroy']]);
    }

    public function datatableAPI()
    {
        $data = $this->roleRepo->all();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn(
                'permissions',
                function ($row) {
                    $permissions = '';
                    foreach ($row->permissions as $permission) {
                        $permissions .= '<span class="badge bg-info p-2 mb-2 me-1">' . $permission->name . '</span>';
                    }
                    return $permissions;
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    $groupButton = '';
                    $action = '';
                    if (auth()->user()->hasAnyPermission(['roles-edit', 'roles-delete'])) {
                        // edit
                        if (auth()->user()->can('roles-edit')) {
                            $groupButton .= '<a href="' . route('roles.edit', $row->id) . '" class="dropdown-item text-warning"><i class="fa fa-edit"></i> Ubah </a>';
                        }

                        // delete
                        if (auth()->user()->can('roles-delete')) {
                            $groupButton .= '<a href="javascript:void(0);" class="dropdown-item text-danger delete" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#confirm-delete"><i class="fa fa-trash"></i> Hapus </a>';
                        }

                        $prefix = '';
                        $prefix .= '<div class="btn-group btn-full-width mb-3">';
                        $prefix .= '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Pilih <i class="mdi mdi-chevron-down"></i> </button>';
                        $prefix .= '<div class="dropdown-menu dropdown-menu-end">';
                        $suffix = '</div></div>';

                        $action = $prefix . $groupButton . $suffix;
                    }

                    return $action;
                }
            )
            ->rawColumns([
                'permissions',
                'action',
            ])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Daftar Peran';
        $data['roles'] = $this->roleRepo->all();

        return view('manajemen.peran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Peran';
        $permissionCollection = $this->permissionRepo->all();

        foreach ($permissionCollection as $value) {
            $tmpPermission[$value->group][] = [
                'id' => $value->id,
                'name' => $value->name,
            ];
        }
        $sorted = collect($tmpPermission)->sortByDesc(function ($stats, $key) {
            return count($stats);
        });

        $data['permissions'] = $sorted;

        return view('manajemen.peran.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $data = $this->roleRepo->store($request);

        if ($data['status']) {
            flash()->addSuccess($data['message']);
            return redirect()->route('roles.index');
        }

        flash()->addError($data['message']);
        return redirect()->back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Ubah Peran';
        $data['role'] = Role::getBy('id', $id);
        $permissionCollection = $this->permissionRepo->all();
        foreach ($permissionCollection as $value) {
            $tmpPermission[$value->group][] = [
                'id' => $value->id,
                'name' => $value->name,
            ];
        }
        $sorted = collect($tmpPermission)->sortByDesc(function ($stats, $key) {
            return count($stats);
        });
        $data['permissions'] = $sorted;
        $data['rolePermissions'] = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('manajemen.peran.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $data = $this->roleRepo->update($request, $id);
        if ($data['status']) {
            flash()->addSuccess($data['message']);
            return redirect()->route('roles.index');
        }

        flash()->addError($data['message']);
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->roleRepo->delete($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus peran',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus peran',
            ]);
        }
    }
}
