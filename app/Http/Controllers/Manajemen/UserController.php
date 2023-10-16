<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;

        $this->middleware('permission:users-browse', ['only' => ['index']]);
        $this->middleware('permission:users-read', ['only' => ['show']]);
        $this->middleware('permission:users-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:users-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }

    public function datatableAPI()
    {
        $data = $this->userRepo->all();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn(
                'role',
                function ($row) {
                    $role = '';
                    if (!empty($row->getRoleNames())) {
                        foreach ($row->getRoleNames() as $v) {
                            $role .= '<span class="badge ' . ($v == 'superadmin' || $v == 'masteradmin' ? 'bg-danger' : 'bg-info') . ' font-size-10 p-2">' . $v . '</span>';
                        }
                    }
                    return $role;
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    $groupButton = '';
                    $action = '';
                    if (auth()->user()->hasAnyPermission(['users-edit', 'users-delete'])) {
                        // edit
                        if (auth()->user()->can('users-edit')) {
                            $groupButton .= '<a href="' . route('users.edit', $row->id) . '" class="dropdown-item text-warning"><i class="fa fa-edit"></i> Ubah </a>';
                        }

                        // delete
                        if (auth()->user()->can('users-delete')) {
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
                'role',
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
        $data['pageTitle'] = 'Daftar User';
        $data['users'] = $this->userRepo->all();

        return view('manajemen.user.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $data['pageTitle'] = 'Profil';

        return view('manajemen.profile.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah User';
        $data['roles'] = $this->userRepo->roles();

        return view('manajemen.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $data = $this->userRepo->store($request);
        if ($data['status']) {
            flash()->addSuccess($data['message']);
            return redirect()->route('users.index');
        }

        flash()->addError($data['message']);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['pageTitle'] = 'Detail User';
        $data['user'] = $this->userRepo->userByID($id);

        return view('manajemen.user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['pageTitle'] = 'Ubah User';
        $data['user'] = $user;
        $data['roles'] = $this->userRepo->roles();
        $data['userRole'] = $data['user']->roles->pluck('name', 'name')->all();

        return view('manajemen.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        if (!empty($request->password) && Str::length($request->password) < 6) {
            return redirect()->back()->withInput()->withErrors(['msg' => 'Password minimal 6 karakter']);
        }
        $data = $this->userRepo->update($request, $id);
        if ($data['status']) {
            flash()->addSuccess($data['message']);
            return redirect()->route('users.index');
        }

        flash()->addError($data['message']);
        return redirect()->back()->withInput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $data = $this->userRepo->updateProfile($request);

        if ($data) {
            flash()->addSuccess('Berhasil update profil');
            return redirect()->route('dashboard');
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
        $data = $this->userRepo->delete($id);
        return response()->json([
            'status' => $data['status'],
            'message' => $data['message'],
        ]);
    }
}
