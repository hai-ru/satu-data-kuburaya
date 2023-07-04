@extends('manajemen.layouts.app')

@section('body', "data-sidebar=dark data-layout=vertical data-layout-mode=light")

@section('wrapper')
    <div id="layout-wrapper">
        @include('manajemen.layouts.header')
        @include('manajemen.layouts.sidebar')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                    @include('manajemen.layouts.footer')
                </div>
            </div>
        </div>
    </div>
@endsection
