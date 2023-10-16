<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\RestApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DatasetViewController extends Controller
{
    public function index(Request $request)
    {
        $data['pageTitle'] = 'Dataset';

        $pd = null;
        $pdSingle = null;
        if ($request->filled('pd')) {
            $bodyPD = [
                'id' => $request->get('pd'),
            ];
            $resPD = RestApiFormatter::get('organization_show', $bodyPD);
            if ($resPD->success) {
                $pdSingle = $resPD->result;
                $pd = $resPD->result->name;
            }
        }

        // ------- Dataset
        $cari = $request->filled('cari') ? $request->get('cari') : '';
        $sortSelected = $request->filled('urutan') ? $request->get('urutan') : 'score desc';
        $totalPage = 1;
        $rows = 10;
        $start = 1;
        $end = 0;
        $page = $request->filled('page') ? $request->get('page') : 1;
        if ($request->filled('page')) {
            if ($request->get('page') > 1) {
                // $start = ($request->get('page') * $rows) - 9;
                $start = $request->get('page') * $rows;
            }
        }

        $list_filter = [];
        if($request->filled('pd')){
            $list_filter[] = 'organization:' . $pd;
        }

        $groupSingle = null;
        if($request->filled('group_id')){
            $list_filter[] = 'groups:'.$request->group_id;
            $resGroup = RestApiFormatter::get('group_show', ['id'=>$request->group_id]);
            if ($resGroup->success) {
                $groupSingle = $resGroup->result;
            }
        }
        
        $fq = "";
        if(count($list_filter) > 0){
            foreach ($list_filter as $key => $value) {
                $fq = $key === 0 ? $fq.$value : $fq." ".$value;
            }
        }
        
        // DD($start);
        if($start === 1) $start = 0;
        $bodyDataset = [
            'q' => $cari,
            'rows' => $rows,
            'start' => $start,
            'include_private' => true,
            'fq' => $fq,
            'sort' => $sortSelected,
        ];
        $resDataset = RestApiFormatter::get('package_search', $bodyDataset);
        // dd($bodyDataset,$resDataset);

        $datasetCount = $resDataset->result->count <= 0 ? 0 : $resDataset->result->count - 1;

        if ($datasetCount > $rows) {
            $end = ($start - 1) + count($resDataset->result->results);
        } else {
            $end = $datasetCount;
        }

        if ($datasetCount > $rows) {
            $totalPage = ceil($datasetCount / $rows);
        }

        // ------- Kategori
        $bodyKategori = [
            'all_fields' => true,
            'include_groups', true,
            // 'groups' => ['dinas-perhubungan', 'ekonomi'],
        ];
        $resKategori = RestApiFormatter::get('group_list', $bodyKategori);

        // ------- Perangkat Daerah
        $bodyOPD = ['all_fields' => true];
        $resOPD = RestApiFormatter::get('organization_list', $bodyOPD);

        $opdSelect = array();
        $opdSidebar = array();
        if ($resOPD->success && $resOPD->result) {
            foreach ($resOPD->result as $item) {
                $opdSelect[] = array(
                    'id' => $item->name,
                    'display_name' => $item->display_name,
                );
                $opdSidebar[] = array(
                    'id' => $item->name,
                    'display_name' => $item->display_name,
                    'package_count' => $item->package_count,
                );
            }
            $data['opdSelect'] = $opdSelect;
            if (!$pd) {
                $data['opdSidebar'] = $opdSidebar;
            }
        }

        $result = json_decode(json_encode($resOPD->result),true);
        $name_list = collect($result)->pluck('name');

        $resOPDnotFields = RestApiFormatter::get('organization_list', []);

        // $not_found = [];
        foreach($resOPDnotFields->result as $item) {
            if(!in_array($item, $name_list->toArray())) {
                $display_name = ucwords(str_replace('-'," ",strtolower($item)));
                $opdSidebar[] = [
                    'id'=>$item,
                    'name'=>$item,
                    'display_name'=>$display_name,
                    'package_count'=>null
                ];
            }
        }
        // $data['not_found'] = $not_found;

        // dd($opdSelect,$opdSidebar);

        // ------- Sort
        $sort = [
            ['id' => 'score desc', 'name' => 'Relevansi'],
            ['id' => 'name asc', 'name' => 'Nama: A ke Z'],
            ['id' => 'name desc', 'name' => 'Nama: Z ke A'],
            ['id' => 'metadata_modified desc', 'name' => 'Terakhir diubah']
        ];

        $data['result'] = array(
            'parameterCari' => $cari,
            'pd' => $pd,
            'page' => $page,
            'totalPage' => $totalPage,
            'dari' => $start,
            'sampai' => $end,
            'total' => $datasetCount,
            'sort' => $sort,
            'urutan' => $sortSelected,
            'pdSingle' => $pdSingle,
            'dataset' => $resDataset->result->results,
            'kategori' => $resKategori->result,
            'opdSelect' => $opdSelect,
            'opdSidebar' => $opdSidebar,
            'groupSingle' => $groupSingle
        );

        return view('frontend.dataset.index', $data);
    }

    public function detail($slug)
    {
        $body = ['id' => $slug];
        $resDataset = RestApiFormatter::get('package_show', $body);
        // dd($resDataset);

        $data['dataset'] = $resDataset->result;
        $data['pageTitle'] = $data['dataset']->title;

        return view('frontend.dataset.detail', $data);
    }
}
