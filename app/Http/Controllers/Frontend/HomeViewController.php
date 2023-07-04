<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\RestApiFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\AjaxTestimoniStoreRequest;
use App\Repositories\InfografikRepository;
use App\Repositories\SliderRepository;
use App\Repositories\TestimoniRepository;
use Illuminate\Http\Request;

class HomeViewController extends Controller
{
    private $infografikRepo;
    private $testimoniRepo;
    private $sliderRepo;

    function __construct(
        InfografikRepository $infografikRepo,
        TestimoniRepository $testimoniRepo,
        SliderRepository $sliderRepo
    ) {
        $this->infografikRepo = $infografikRepo;
        $this->testimoniRepo = $testimoniRepo;
        $this->sliderRepo = $sliderRepo;
    }

    public function index()
    {
        $data['pageTitle'] = 'Beranda';

        // --------- Total Dataset
        $resDataset = RestApiFormatter::get('package_list');
        $data['total_dataset'] = count($resDataset->result);

        // --------- Perangkat Daerah
        $resOPD = RestApiFormatter::get('organization_list');
        $data['total_opd'] = count($resOPD->result);

        // --------- Daftar kategori
        $body = ['all_fields' => true];
        $resKategori = RestApiFormatter::get('group_list', $body);
        $data['kategori'] = $resKategori->result;

        // --------- Daftar Slider
        $scopeSlider[] = ['is_active', '=', true];
        $data['slider'] = $this->sliderRepo->get($scopeSlider);

        // --------- Daftar Infografik
        $data['infografik'] = $this->infografikRepo->get();
        
        // --------- Daftar Testimoni
        $scopeTestimoni[] = ['is_show', '=', true];
        $selectTestimoni = ['nama', 'rating', 'testimoni'];
        $data['testimoni'] = $this->testimoniRepo->get($scopeTestimoni, $selectTestimoni);

        return view('frontend.home', $data);
    }

    public function storeTestimoni(AjaxTestimoniStoreRequest $request)
    {
        $data = $this->testimoniRepo->store($request);

        if ($data['status']) {
            $message = 'Terimakasih telah memberikan testimoni. Testimoni Anda akan dimoderasi terlebih dahulu';
        } else {
            $message = 'Gagal memberikan testimoni, Silakan coba beberapa saat lagi';
        }

        return response()->json([
            'status' => $data['status'],
            'message' => $message,
        ]);
    }
}
