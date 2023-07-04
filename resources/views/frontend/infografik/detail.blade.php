@extends('frontend.layouts.app')

@push('styles')
    <style>
        iframe{
            width: 100%;
            height: 250vh;
            border:0;
        }
    </style>
@endpush

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
                        <h1 class="text-white mb-0">{{$infografik->judul ?? ""}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header section end-->
    <section class="our-blog-section ptb-100">
        <div class="container">
            @if (!empty($infografik->pdf))    
                <div class="text-right mb-3">
                    <a download target="_blank" href="{{ $infografik->pdf }}" class="btn btn-primary"><i class="fa fa-download"></i> Unduh PDF</a>
                </div>
            @endif
            <iframe 
                id="iframe_container"
                src="{{ $infografik->link ?? "" }}" 
                frameborder="0" 
                allowfullscreen
                {{-- onload="resizeIframe(this)" --}}
            >
            </iframe>
        </div>
    </section>
@endsection

{{-- @push('scripts')
    <script>
        // $('#iframe_container').load(function() {
            // alert('a')
            // setTimeout(iResize, 50);
            // // Safari and Opera need a kick-start.
            // var iSource = document.getElementById('iframe_container').src;
            // document.getElementById('iframe_container').src = '';
            // document.getElementById('iframe_container').src = iSource;
        // });

        // function resizeIframe(elm) {
            // alert('load')
            // console.log(elm.contentWindow)
            // console.log('height>>',document.getElementById('iframe_container').contentWindow.document.body.offsetHeight)
        // }
        // function iResize() {
            // document.getElementById('iframe_container').style.height = 
            // document.getElementById('iframe_container').contentWindow.document.body.offsetHeight + 'px';
        // }
    </script>
@endpush --}}