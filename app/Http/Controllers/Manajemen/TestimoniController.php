<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimoniStoreRequest;
use App\Http\Requests\TestimoniUpdateRequest;
use App\Models\Testimoni;
use App\Repositories\TestimoniRepository;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    private $testimoniRepo;

    function __construct(TestimoniRepository $testimoniRepo)
    {
        $this->testimoniRepo = $testimoniRepo;

        $this->middleware('permission:testimoni-browse', ['only' => ['index']]);
        $this->middleware('permission:testimoni-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:testimoni-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:testimoni-delete', ['only' => ['destroy']]);
        $this->middleware('permission:testimoni-update-status', ['only' => ['updateShow']]);
    }

    public function datatableAPI()
    {
        $data = $this->testimoniRepo->get();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn(
                'nama_email',
                function ($row) {
                    $data = '';

                    $data .= $row->nama;
                    $data .= '<br><small class="text-muted">' . $row->email . '</small>';

                    return $data;
                }
            )
            ->editColumn(
                'rating',
                function ($row) {
                    $keterangan = '';

                    if ($row->rating >= 1) {
                        $keterangan .= '<li class="list-inline-item"><span class="fas fa-star ratting-color"></span></li>';
                    }
                    if ($row->rating >= 2) {
                        $keterangan .= '<li class="list-inline-item"><span class="fas fa-star ratting-color"></span></li>';
                    }
                    if ($row->rating >= 3) {
                        $keterangan .= '<li class="list-inline-item"><span class="fas fa-star ratting-color"></span></li>';
                    }
                    if ($row->rating >= 4) {
                        $keterangan .= '<li class="list-inline-item"><span class="fas fa-star ratting-color"></span></li>';
                    }
                    if ($row->rating >= 5) {
                        $keterangan .= '<li class="list-inline-item"><span class="fas fa-star ratting-color"></span></li>';
                    }

                    $prefix = '';
                    $prefix .= '<div class="client-ratting text-warning">';
                    $prefix .= '<ul class="list-inline client-ratting-list">';
                    $suffix = '</ul></div>';

                    $data = $prefix . $keterangan . $suffix;

                    return $data;
                }
            )
            ->editColumn(
                'is_show',
                function ($row) {
                    $data = '';
                    $data .= '<input type="checkbox" id="switch-show-' . $row->id . '" data-id="' . $row->id . '" class="switch-show" switch="success" ' . ($row->is_show ? 'checked ' : ' ') . (auth()->user()->can('testimoni-update-status') ? ' ' : 'disabled ') . '/>';
                    $data .= '<label for="switch-show-' . $row->id . '" data-on-label="Ya" data-off-label="Tidak"></label>';

                    return $data;
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    $groupButton = '';
                    $action = '';
                    if (auth()->user()->hasAnyPermission(['testimoni-read', 'testimoni-edit', 'testimoni-delete'])) {
                        // detail
                        if (auth()->user()->can('testimoni-read')) {
                            $groupButton .= '<a href="' . route('testimoni.show', $row->id) . '" class="dropdown-item text-warning"><i class="fa fa-eye"></i> Detail </a>';
                        }

                        // edit
                        if (auth()->user()->can('testimoni-edit')) {
                            $groupButton .= '<a href="' . route('testimoni.edit', $row->id) . '" class="dropdown-item text-warning"><i class="fa fa-edit"></i> Ubah </a>';
                        }

                        // delete
                        if (auth()->user()->can('testimoni-delete')) {
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
                'nama_email',
                'rating',
                'is_show',
                'action',
            ])
            ->make(true);
    }

    public function index()
    {
        $data['pageTitle'] = 'Testimoni';

        return view('manajemen.testimoni.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Tambah Testimoni';

        return view('manajemen.testimoni.create', $data);
    }

    public function store(TestimoniStoreRequest $request)
    {
        $data = $this->testimoniRepo->store($request);

        if ($data['status']) {
            flash()->addSuccess($data['message']);
            return redirect()->route('testimoni.index');
        }

        flash()->addError($data['message']);
        return redirect()->back()->withInput();
    }

    public function edit(Testimoni $testimoni)
    {
        $data['pageTitle'] = 'Ubah Testimoni';
        $data['testimoni'] = $testimoni;

        return view('manajemen.testimoni.edit', $data);
    }

    public function update(TestimoniUpdateRequest $request, Testimoni $testimoni)
    {
        $data = $this->testimoniRepo->update($request, $testimoni);

        if ($data['status']) {
            flash()->addSuccess($data['message']);
            return redirect()->route('testimoni.index');
        }

        flash()->addError($data['message']);
        return redirect()->back()->withInput();
    }

    public function updateStatus($id)
    {
        $status = false;
        $message = 'Gagal update status testimoni';

        $data = $this->testimoniRepo->updateStatus($id);
        if ($data) {
            $status = true;
            $message = 'Berhasil update status testimoni';
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }

    public function destroy(Testimoni $testimoni)
    {
        $data = $this->testimoniRepo->delete($testimoni);

        return response()->json([
            'status' => $data['status'],
            'message' => $data['message'],
        ]);
    }
}
