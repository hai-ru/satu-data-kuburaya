<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\RestApiFormatter;
use App\Http\Controllers\Controller;
use App\Repositories\GrupRepository;
use App\Repositories\InfografikRepository;
use Illuminate\Http\Request;

class InfografikViewController extends Controller
{
    private $infografikRepo;
    private $grupRepo;

    function __construct(
        InfografikRepository $infografikRepo,
        GrupRepository $grupRepo
    ) {
        $this->infografikRepo = $infografikRepo;
        $this->grupRepo = $grupRepo;
    }

    public function index()
    {
        $data['pageTitle'] = 'Infografik';
        $data['infografik'] = $this->infografikRepo->get(null, 8);

        // kategori
        $resKategori = $this->grupRepo->get();
        $kategori = array();
        foreach ($resKategori as $item) {
            $kategori[$item->id] = $item->display_name;
        }
        $data['kategori'] = $kategori;

        // perangkat daerah
        $bodyOPD = ['all_fields' => true];
        $resOPD = RestApiFormatter::get('organization_list', $bodyOPD);
        $opd = array();
        foreach ($resOPD->result as $item) {
            $opd[$item->id] = $item->display_name;
        }
        $data['opd'] = $opd;

        return view('frontend.infografik.index', $data);
    }

    public function detail($slug)
    {
        $infografik = new InfografikRepository();
        $data['infografik'] = $infografik->first($slug);
        if(empty($data['infografik'])) return abort(404);
        $data['pageTitle'] = $data['infografik']?->judul ?? "";
        return view('frontend.infografik.detail',$data);
    }
}
