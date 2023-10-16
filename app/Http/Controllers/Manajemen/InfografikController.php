<?php

namespace App\Http\Controllers\Manajemen;

use Illuminate\Http\Request;

use App\Helpers\RestApiFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\InfografikStoreRequest;
use App\Http\Requests\InfografikUpdateRequest;
use App\Models\Infografik;
use App\Repositories\InfografikRepository;
use App\Repositories\GrupRepository;
use App\Repositories\OrganisasiRepository;

class InfografikController extends Controller
{
    private $infografikRepo;
    private $grupRepo;

    function __construct(
        InfografikRepository $infografikRepo,
        GrupRepository $grupRepo
    ) {
        $this->infografikRepo = $infografikRepo;
        $this->grupRepo = $grupRepo;

        $this->middleware('permission:infografik-browse', ['only' => ['index']]);
        $this->middleware('permission:infografik-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:infografik-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:infografik-delete', ['only' => ['destroy']]);
    }

    public function datatableAPI()
    {
        $data = $this->infografikRepo->get();
        $grup = $this->grupRepo->get();

        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn(
                'group_id',
                function ($row) use ($grup) {
                    $data = '';
                    foreach ($grup as $item) {
                        if ($item->id == $row->group_id) {
                            $data = $item->display_name;
                        }
                    }

                    return $data;
                }
            )
            ->editColumn(
                'gambar',
                function ($row) {
                    if(empty($row->gambarInfografik)) return null;
                    $data = '<img src="' . url('uploads/infografik/thumbnail/' . $row->gambarInfografik->gambar) . '" style="width: 100px;" alt="' . $row->judul . '">';

                    return $data;
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    $groupButton = '';
                    $action = '';
                    if (auth()->user()->hasAnyPermission(['infografik-read', 'infografik-edit', 'infografik-delete'])) {
                        // detail
                        if (auth()->user()->can('infografik-read')) {
                            $groupButton .= '<a href="' . route('frontend.infografik.detail', $row->slug) . '" class="dropdown-item text-warning"><i class="fa fa-eye"></i> Detail </a>';
                        }

                        // edit
                        if (auth()->user()->can('infografik-edit')) {
                            $groupButton .= '<a href="' . route('infografik.edit', $row->slug) . '" class="dropdown-item text-warning"><i class="fa fa-edit"></i> Ubah </a>';
                        }

                        // delete
                        if (auth()->user()->can('infografik-delete')) {
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
                'gambar',
                'action',
            ])
            ->make(true);
    }

    public function index()
    {
        $data['pageTitle'] = 'Infografik';

        return view('manajemen.infografik.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Tambah Infografik';

        $resGrup = $this->grupRepo->get();
        $grup = array();
        foreach ($resGrup as $item) {
            $grup[$item->id] = $item->display_name;
        }
        $data['grup'] = $grup;
        // $data['tipe'] = Infografik::getTipeAvailable();

        return view('manajemen.infografik.create', $data);
    }

    // public function store(InfografikStoreRequest $request)
    public function store(Request $request)
    {
        $data = $this->infografikRepo->store($request);

        if ($data['status']) {
            flash()->addSuccess($data['message']);
            return redirect()->route('infografik.index');
        }

        flash()->addError($data['message']);
        return redirect()->back()->withInput();
    }

    public function edit($slug)
    {
        $infografik = $this->infografikRepo->first($slug);
        if ($infografik) {
            $data['pageTitle'] = 'Ubah Infografik';
            $data['infografik'] = $infografik;
            $resGrup = $this->grupRepo->get();
            $grup = array();
            foreach ($resGrup as $item) {
                $grup[$item->id] = $item->display_name;
            }
            $data['grup'] = $grup;

            return view('manajemen.infografik.edit', $data);
        }

        flash()->addError('Data infografik tidak ditemukan');
        return redirect()->back();
    }

    public function update(Request $request, $slug)
    {
        // DD($request->all());
        $infografik = $this->infografikRepo->first($slug);
        if ($infografik) {
            $data = $this->infografikRepo->update($request, $infografik);

            if ($data['status']) {
                flash()->addSuccess($data['message']);
                return redirect()->route('infografik.index');
            }

            flash()->addError($data['message']);
            return redirect()->back()->withInput();
        }

        flash()->addError('Data infografik tidak ditemukan');
        return redirect()->back();
    }

    public function destroy($slug)
    {
        $infografik = $this->infografikRepo->first($slug);
        if ($infografik) {
            $data = $this->infografikRepo->delete($infografik);
        } else {
            $data['status'] = false;
            $data['message'] = 'Data infografik tidak ditemukan';
        }

        return response()->json([
            'status' => $data['status'],
            'message' => $data['message'],
        ]);
    }
}
