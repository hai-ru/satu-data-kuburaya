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
        // dd($resOPD);

        return view('frontend.perangkat-daerah', $data);
    }
}
