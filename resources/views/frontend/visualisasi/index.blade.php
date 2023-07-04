@extends('frontend.layouts.app')

@section('content')
    <!--header section start-->
    <section class="hero-section ptb-100 gradient-overlay"
        style="background: url('{{ asset('frontend/img/header-bg-5.jpg') }}')no-repeat center center / cover">
        <div class="hero-bottom-shape-two"
            style="background: url('{{ asset('frontend/img/hero-bottom-shape.svg') }}')no-repeat bottom center"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 mt-5">
                    <div class="page-header-content text-white text-center pt-sm-5 pt-md-5 pt-lg-0">
                        <h1 class="text-white mb-0">Visualisasi</h1>
                        <div class="custom-breadcrumb">
                            Grafik realisasi kelengkapan dataset terhadap perangkat daerah pertahun
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header section end-->
@endsection
