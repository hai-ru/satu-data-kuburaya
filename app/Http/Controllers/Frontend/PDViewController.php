<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\RestApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PDViewController extends Controller
{
    public function index()
    {
        $data['pageTitle'] = 'Perangkat Daerah';

        // perangkat daerah
        $body = ['all_fields' => true];
        $resOPD = RestApiFormatter::get('organization_list', $body);
        $data['opd'] = $resOPD->result;

        $result = json_decode(json_encode($resOPD->result),true);
        $name_list = collect($result)->pluck('name');

        $resOPDnotFields = RestApiFormatter::get('organization_list', []);

        $not_found = [];
        foreach($resOPDnotFields->result as $item) {
            if(!in_array($item, $name_list->toArray())) {
                $display_name = ucwords(str_replace('-'," ",strtolower($item)));
                $not_found[] = [
                    'name'=>$item,
                    'display_name'=>$display_name,
                    'image_display_url'=>null
                ];
            }
        }
        $data['not_found'] = $not_found;


        return view('frontend.perangkat-daerah', $data);
    }
}
