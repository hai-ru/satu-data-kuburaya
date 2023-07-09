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
                        <h1 class="text-white mb-0">Perangkat Daerah</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header section end-->

    @if (count($opd) > 0)
        <!--contact us promo start-->
        <section class="contact-us-promo pt-100 pb-100">
            <div class="container">
                <div class="row">
                    @foreach ($opd as $item)
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                            <div class="card single-promo-card single-promo-hover shadow-sm">
                                <div class="card-body py-5">
                                    <div class="pb-2 text-center">
                                        <img src="{{ $item->image_display_url ? $item->image_display_url : asset('frontend/img/data-analytics.svg') }}"
                                            alt="{{ $item->display_name }}" class="mb-3" height="100">
                                    </div>
                                    <div>
                                        <h6 class="mb-0 three-lines-words text-center">{{ $item->display_name }}</h6>
                                        <a href="{{ route('frontend.dataset.index',['pd'=> $item->name ]) }}" class="btn btn-primary btn-block mt-3">
                                            {{ $item->package_count - 1 }} Dataset
                                        </a>
                                        {{-- <p class="font-weight-bold text-primary mb-0">{{ $item->package_count - 1 }} Dataset</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--contact us promo end-->
    @endif
@endsection
