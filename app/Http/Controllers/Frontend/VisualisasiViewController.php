<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisualisasiViewController extends Controller
{
    public function index()
    {
        $data['pageTitle'] = 'Visualisasi';
        
        return view('frontend.visualisasi.index', $data);
    }
}
