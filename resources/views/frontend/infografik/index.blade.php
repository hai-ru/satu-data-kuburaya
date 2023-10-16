@extends('frontend.layouts.app')

@push('styles')
    <style>
        .loader_image{
            width: 100%;
            height: 188.758px;
            background-color: gray;
            color: #dcdcdc;
            align-items: center;
            justify-content: center;
            display: flex;
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
                        <h1 class="text-white mb-0">Visualisasi</h1>
                        <div class="custom-breadcrumb">
                            Visualisasi adalah informasi yang disajikan dalam bentuk grafik agar lebih mudah dipahami
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header section end-->

    <!--blog section start-->
    <section class="our-blog-section ptb-100">
        <div class="container">
            <div class="row">
                @foreach ($infografik as $item)
                    <a href="{{ route('frontend.infografik.detail', $item->slug) }}">
                        <div class="col-md-3">
                            <div class="single-blog-card card border-0 shadow-sm">
                                @if ($item->group_id && count($kategori) > 0 && !empty($kategori[$item->group_id]))
                                    <span class="category position-absolute badge badge-pill badge-primary">
                                        {{ $kategori[$item->group_id] }}
                                    </span>
                                @endif
                                @if (!empty($item->gambarInfografik?->gambar))    
                                    <img src="{{ url('uploads/infografik/' . $item->gambarInfografik->gambar) }}"
                                        class="card-img-top position-relative" alt="{{ $item->judul }}">
                                        
                                    @else
                                    <div class="card-img-top position-relative loader_image">
                                        <i class="fa fa-chart-line fa-5x"></i>
                                    </div>                                        
                                @endif
                                <div class="card-body">
                                    <h3 class="h5 mb-2 card-title two-lines-words"><a href="{{ route('frontend.infografik.detail', $item->slug) }}">{{ $item->judul }}</a>
                                    </h3>
                                    <div class="post-meta mb-2">
                                        <ul class="meta-list">
                                            <li>
                                                <i class="fa fa-calendar"></i>
                                                {{ date('d-m-Y', strtotime($item->created_at)) }}
                                            </li>
                                            <li>
                                                <i class="fa fa-building"></i>
                                                {{ !empty($opd[$item->author_id]) ? $opd[$item->author_id] : '-' }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!--pagination start-->
            {{ $infografik->links('frontend.layouts.pagination') }}
            <!--pagination end-->

        </div>
    </section>
    <!--blog section end-->
@endsection
