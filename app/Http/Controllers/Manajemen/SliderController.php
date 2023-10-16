<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Models\Slider;
use App\Repositories\SliderRepository;

class SliderController extends Controller
{
    private $sliderRepo;

    function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;

        $this->middleware('permission:slider-browse', ['only' => ['index']]);
        $this->middleware('permission:slider-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:slider-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:slider-delete', ['only' => ['destroy']]);
    }

    public function datatableAPI()
    {
        $data = $this->sliderRepo->get();

        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn(
                'gambar',
                function ($row) {
                    $data = '<img src="' . url('uploads/slider/thumbnail/' . $row->gambar) . '" style="width: 150px;" alt="' . $row->judul . '">';

                    return $data;
                }
            )
            ->editColumn(
                'is_active',
                function ($row) {
                    $data = '<span class="badge ' . ($row->is_active ? 'bg-success' : 'bg-danger') . ' p-2" style="font-size: 7pt">' . ($row->is_active ? 'AKTIF' : 'TIDAK AKTIF') . '</span>';

                    return $data;
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    $groupButton = '';
                    $action = '';
                    if (auth()->user()->hasAnyPermission(['slider-read', 'slider-edit', 'slider-delete'])) {
                        // detail
                        if (auth()->user()->can('slider-read')) {
                            $groupButton .= '<a href="' . route('slider.show', $row->slug) . '" class="dropdown-item text-warning"><i class="fa fa-eye"></i> Detail </a>';
                        }

                        // edit
                        if (auth()->user()->can('slider-edit')) {
                            $groupButton .= '<a href="' . route('slider.edit', $row->slug) . '" class="dropdown-item text-warning"><i class="fa fa-edit"></i> Ubah </a>';
                        }

                        // delete
                        if (auth()->user()->can('slider-delete')) {
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
                'is_active',
                'gambar',
                'action',
            ])
            ->make(true);
    }

    public function index()
    {
        $data['pageTitle'] = 'Slider';

        return view('manajemen.slider.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Tambah Slider';

        return view('manajemen.slider.create', $data);
    }

    public function store(SliderStoreRequest $request)
    {
        $data = $this->sliderRepo->store($request);

        if ($data['status']) {
            flash()->addSuccess($data['message']);
            return redirect()->route('slider.index');
        }

        flash()->addError($data['message']);
        return redirect()->back()->withInput();
    }

    public function edit($slug)
    {
        $slider = $this->sliderRepo->first($slug);
        if ($slider) {
            $data['pageTitle'] = 'Ubah Slider';
            $data['slider'] = $slider;

            return view('manajemen.slider.edit', $data);
        }

        flash()->addError('Data slider tidak ditemukan');
        return redirect()->back();
    }

    public function update(SliderUpdateRequest $request, $slug)
    {
        $slider = $this->sliderRepo->first($slug);
        if ($slider) {
            $data = $this->sliderRepo->update($request, $slider);

            if ($data['status']) {
                flash()->addSuccess($data['message']);
                return redirect()->route('slider.index');
            }

            flash()->addError($data['message']);
            return redirect()->back()->withInput();
        }

        flash()->addError('Data slider tidak ditemukan');
        return redirect()->back();
    }

    public function destroy($slug)
    {
        $slider = $this->sliderRepo->first($slug);
        if ($slider) {
            $data = $this->sliderRepo->delete($slider);
        } else {
            $data['status'] = false;
            $data['message'] = 'Data slider tidak ditemukan';
        }

        return response()->json([
            'status' => $data['status'],
            'message' => $data['message'],
        ]);
    }
}
