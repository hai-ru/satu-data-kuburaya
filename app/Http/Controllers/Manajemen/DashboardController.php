<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct() {
        //
    }

    public function index()
    {
        $data['pageTitle'] = 'Dashboard';

        return view('manajemen.dashboard.index', $data);
    }
}
