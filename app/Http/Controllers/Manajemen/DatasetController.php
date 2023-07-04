<?php

namespace App\Http\Controllers\Manajemen;

use App\Helpers\RestApiFormatter;
use App\Http\Controllers\Controller;
use App\Repositories\DatasetRepository;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    private $datasetRepo;

    function __construct(DatasetRepository $datasetRepo)
    {
        $this->datasetRepo = $datasetRepo;

        $this->middleware('permission:dataset-browse', ['only' => ['index']]);
        $this->middleware('permission:dataset-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:dataset-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:dataset-delete', ['only' => ['destroy']]);
        $this->middleware('permission:file-dataset-browse', ['only' => ['indexResource']]);
        $this->middleware('permission:file-dataset-edit', ['only' => ['editResource', 'updateResource']]);
        $this->middleware('permission:file-dataset-add', ['only' => ['createResource', 'storeResource']]);
        $this->middleware('permission:file-dataset-delete', ['only' => ['destroyResource']]);
    }

    public function index(Request $request)
    {
        $data['pageTitle'] = 'Dataset';

        // dataset
        $cari = $request->filled('cari') ? $request->get('cari') : '';
        $rows = 10;
        $start = 1;
        $end = 0;
        $page = $request->filled('page') ? $request->get('page') : 1;
        if ($request->filled('page')) {
            if ($request->get('page') > 1) {
                $start = ($request->get('page') * $rows) - 9;
            }
        }
        $bodyDataset = [
            'q' => $cari,
            'rows' => $rows,
            'start' => $start,
            'include_private' => true,
        ];
        $resDataset = RestApiFormatter::get('package_search', $bodyDataset);
        // dd($resDataset);

        if ($resDataset->result->count > $rows) {
            $end = ($start - 1) + count($resDataset->result->results);
        } else {
            $end = $resDataset->result->count;
        }

        if ($resDataset->result->count > $rows) {
            $totalPage = ceil($resDataset->result->count / $rows);
        }
        
        $data['result'] = array(
            'parameterCari' => $cari,
            'page' => $page,
            'total_page' => $totalPage,
            'dari' => $start,
            'sampai' => $end,
            'total' => $resDataset->result->count - 1,
            'dataset' => $resDataset->result->results,
        );

        return view('manajemen.dataset.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Tambah Dataset';

        // lisensi
        $resLisensi = RestApiFormatter::get('license_list');
        $lisensi = array();
        foreach ($resLisensi->result as $item) {
            $lisensi[$item->id] = $item->title;
        }
        $data['lisensi'] = $lisensi;

        // perangkat daerah
        $bodyOPD = ['all_fields' => true];
        $resOPD = RestApiFormatter::get('organization_list', $bodyOPD);
        $opd = array();
        foreach ($resOPD->result as $item) {
            $opd[$item->id] = $item->display_name;
        }
        $data['opd'] = $opd;

        // kategori
        $bodyGrup = ['all_fields' => true];
        $resGrup = RestApiFormatter::get('group_list', $bodyGrup);
        $grup = array();
        foreach ($resGrup->result as $item) {
            $grup[$item->id] = $item->display_name;
        }
        $data['grup'] = $grup;

        return view('manajemen.dataset.create', $data);
    }
}
