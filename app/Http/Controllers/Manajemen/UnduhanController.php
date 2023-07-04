<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnduhanStoreRequest;
use App\Http\Requests\UnduhanUpdateRequest;
use App\Repositories\UnduhanRepository;
use Illuminate\Http\Request;

class UnduhanController extends Controller
{
    private $unduhanRepo;

    function __construct(UnduhanRepository $unduhanRepo)
    {
        $this->unduhanRepo = $unduhanRepo;

        $this->middleware('permission:unduhan-browse', ['only' => ['index']]);
        $this->middleware('permission:unduhan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:unduhan-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:unduhan-delete', ['only' => ['destroy']]);
    }

    public function datatableAPI()
    {
        $data = $this->unduhanRepo->get();

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
            ->addColumn(
                'action',
                function ($row) {
                    $groupButton = '';
                    $action = '';
                    if (auth()->user()->hasAnyPermission(['unduhan-read', 'unduhan-edit', 'unduhan-delete'])) {
                        // edit
                        if (auth()->user()->can('unduhan-edit')) {
                            $groupButton .= '<a href="' . route('unduhan.edit', $row->slug) . '" class="dropdown-item text-warning"><i class="fa fa-edit"></i> Ubah </a>';
                        }

                        // delete
                        if (auth()->user()->can('unduhan-delete')) {
                            $groupButton .= '<a href="javascript:void(0);" class="dropdown-item text-danger delete" data-slug="' . $row->slug . '" data-bs-toggle="modal" data-bs-target="#confirm-delete"><i class="fa fa-trash"></i> Hapus </a>';
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
                'action',
            ])
            ->make(true);
    }

    public function index()
    {
        $data['pageTitle'] = 'Unduhan';

        return view('manajemen.unduhan.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Tambah Unduhan';

        return view('manajemen.unduhan.create', $data);
    }

    public function store(UnduhanStoreRequest $request)
    {
        $data = $this->unduhanRepo->store($request);

        if ($data['status']) {
            flash()->addSuccess($data['message']);
            return redirect()->route('unduhan.index');
        }

        flash()->addError($data['message']);
        return redirect()->back()->withInput();
    }

    public function edit($slug)
    {
        $unduhan = $this->unduhanRepo->first($slug);
        if ($unduhan) {
            $data['pageTitle'] = 'Ubah Unduhan';
            $data['unduhan'] = $unduhan;

            return view('manajemen.unduhan.edit', $data);
        }

        flash()->addError('Data unduhan tidak ditemukan');
        return redirect()->back();
    }

    public function update(UnduhanUpdateRequest $request, $slug)
    {
        $unduhan = $this->unduhanRepo->first($slug);
        if ($unduhan) {
            $data = $this->unduhanRepo->update($request, $unduhan);

            if ($data['status']) {
                flash()->addSuccess($data['message']);
                return redirect()->route('unduhan.index');
            }

            flash()->addError($data['message']);
            return redirect()->back()->withInput();
        }

        flash()->addError('Data unduhan tidak ditemukan');
        return redirect()->back();
    }

    public function destroy($slug)
    {
        $unduhan = $this->unduhanRepo->first($slug);
        if ($unduhan) {
            $data = $this->unduhanRepo->delete($unduhan);
        } else {
            $data['status'] = false;
            $data['message'] = 'Data unduhan tidak ditemukan';
        }

        return response()->json([
            'status' => $data['status'],
            'message' => $data['message'],
        ]);
    }
}
