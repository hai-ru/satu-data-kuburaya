@extends('frontend.layouts.app')

@push('styles')
    <style>
        .img-opd {
            max-height: 100%;
            height: auto;
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
            <div class="row justify-content-center mt-5">
                <div class="col-md-8 col-lg-7">
                    <div class="page-header-content text-white text-center pt-sm-5 pt-md-5 pt-lg-0">
                        <h1 class="text-white mb-0">Dataset</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header section end-->

    <section class="our-portfolio-section mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-heading text-center mb-5">
                        <p class="lead">
                            Di halaman ini tersedia daftar Dataset yang membangun ekosistem data yang terbuka
                            dan terpercaya melalui publikasi di Visualisasi Satu Data Pemerintah Kabupaten Kuburaya
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4">
                    @if ($result['pdSingle'])
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="card text-center single-pricing-pack">
                                    <div class="pricing-img mt-4">
                                        <img src="{{ $result['pdSingle']->image_display_url && $result['pdSingle']->image_display_url !== "" ? $result['pdSingle']->image_display_url : asset('frontend/img/data-analytics.svg') }}"
                                            alt="{{ $result['pdSingle']->display_name }}" 
                                            class="img-opd"
                                        >
                                        {{-- <img src="{{ $result['pdSingle']->image_display_url }}"
                                            alt="{{ $result['pdSingle']->display_name }}" 
                                            class="img-opd"
                                        > --}}
                                    </div>
                                    <div class="card-header py-4 border-0 pricing-header">
                                        <div class="h5 text-center mb-0">
                                            <span class="price font-weight-bolder">
                                                {{ $result['pdSingle']->display_name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body mb-3">
                                        <span class="badge badge-primary pl-3 pt-2 pr-3 pb-2"
                                            style="font-size: 12pt !important;">
                                            {{ $result['pdSingle']->package_count }} Dataset
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($result['groupSingle'])
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="card text-center single-pricing-pack">
                                    <div class="pricing-img mt-4">
                                        <img src="{{ $result['groupSingle']->image_display_url && $result['groupSingle']->image_display_url !== "" ? $result['groupSingle']->image_display_url : asset('frontend/img/data-analytics.svg') }}"
                                            alt="{{ $result['groupSingle']->display_name }}" 
                                            class="img-opd"
                                        >
                                        {{-- <img src="{{ $result['groupSingle']->image_display_url }}"
                                            alt="{{ $result['groupSingle']->display_name }}" 
                                            class="img-opd"
                                        > --}}
                                    </div>
                                    <div class="card-header py-4 border-0 pricing-header">
                                        <div class="h5 text-center mb-0">
                                            <span class="price font-weight-bolder">
                                                {{ $result['groupSingle']->display_name }}
                                            </span>
                                        </div>
                                        <p class="text-center">
                                            {{ $result['groupSingle']->description }}
                                        </p>
                                    </div>
                                    <div class="card-body mb-3">
                                        <span class="badge badge-primary pl-3 pt-2 pr-3 pb-2"
                                            style="font-size: 12pt !important;">
                                            {{ $result['groupSingle']->package_count }} Dataset
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <!-- Organization widget-->
                            <aside class="widget widget-categories mb-5">
                                <div class="widget-title">
                                    <h5>Perangkat Daerah</h6>
                                </div>
                                <div class="list">
                                    <ul>
                                        @foreach ($result['opdSidebar'] as $item)
                                            <li>
                                                <a href="{{ route('frontend.dataset.index', ['pd=' . $item['id']]) }}"
                                                    class="d-flex d-inline">
                                                    <span class="one-lines-words mr-2" style="width: 90% !important;">
                                                        {{ $item['display_name'] }}
                                                    </span>
                                                    @if($item['package_count'])
                                                        <span class="badge badge-secondary pr-2 pl-2 float-right">
                                                            {{ $item['package_count'] }}
                                                        </span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <span class="more-less"></span>
                                </div>
                            </aside>

                            <!-- Categories widget-->
                            <aside class="widget widget-categories mb-0">
                                <div class="widget-title">
                                    <h5>Kategori</h6>
                                </div>
                                <ul>
                                    @foreach ($result['kategori'] as $item)
                                    {{-- {{DD($item)}} --}}
                                        <li>
                                            <a href="{{ route('frontend.dataset.index',['group_id'=>$item->name]) }}" class="d-flex d-inline">
                                                <span class="one-lines-words mr-2" style="width: 90% !important;">
                                                    {{ $item->display_name }}
                                                </span>
                                                <span class="badge badge-secondary pr-2 pl-2 float-right">
                                                    {{ $item->package_count }}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <form id="form-filter" action="{{ route('frontend.dataset.index') }}" method="GET">
                                <input type="hidden" id="page" name="page">
                                <input type="hidden" id="sort" name="sort">
                                @if(Request::get('pd'))
                                    <input type="hidden" name="pd" value="{{ Request::get('pd') }}">
                                @endif
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input class="form-control pl-4 pr-4" name="cari" id="cari"
                                            placeholder="Cari Dataset" value="{{ $result['parameterCari'] }}">
                                    </div>
                                    <div class="col-sm-12 col-md-6 mt-md-2 pr-md-1">
                                        @if ($result['opdSelect'])
                                            <select name="pd" id="pd" class="form-control select2"
                                                data-placeholder="Pilih Perangkat Daerah" style="width: 100%">
                                                <option value=""></option>
                                                @foreach ($result['opdSelect'] as $item)
                                                    <option value="{{ $item['id'] }}">
                                                        {{-- {{ isset($result['pd']) && $item['id'] == $result['pd'] ? 'selected' : '' }}> --}}
                                                        {{ $item['display_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-6 mt-md-2 pl-md-1">
                                        @if ($result['kategori'])
                                            <select name="group_id" id="group_id" class="form-control select2"
                                                data-placeholder="Pilih Kategori" style="width: 100%">
                                                <option value=""></option>
                                                @foreach ($result['kategori'] as $item)
                                                    <option value="{{ $item->name }}">{{ $item->display_name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 mt-md-3 text-right">
                                        <button type="button" class="btn btn-secondary mr-2" id="btn-filter-clear">
                                            <i class="fa fa-trash-restore mr-1"></i> Bersihkan
                                        </button>
                                        <button type="submit" class="btn btn-info" id="btn-filter">
                                            <i class="fa fa-search mr-1"></i>
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-12 col-md-8">
                                    <div class="mt-3 ml-3">
                                        <strong>{{ $result['total'] }}</strong> Dataset ditemukan
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    @if ($result['sort'])
                                        <select name="sort" id="sort" class="form-control select2"
                                            style="width: 100%">
                                            @foreach ($result['sort'] as $item)
                                                <option value="{{ $item['id'] }}"
                                                    {{ isset($result['urutan']) && $item['id'] == $result['urutan'] ? 'selected' : '' }}>
                                                    {{ $item['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <aside class="widget widget-recent-entries-custom mb-0">
                                <ul>
                                    @foreach ($result['dataset'] as $item)
                                        <li class="clearfix {{ $loop->even ? 'gray-light-bg' : '' }}">
                                            <div class="wb">
                                                <a href="{{ route('frontend.dataset.detail', $item->name) }}">
                                                    <strong class="text-dark" style="font-size: 14pt; line-height: 1.2em">
                                                        {{ $item->title }}
                                                    </strong>
                                                </a>
                                                <div style="font-size: 8pt">
                                                    <i class="fa fa-building text-primary mr-1"></i>
                                                    {{ $item->organization->title }}
                                                </div>
                                                <div style="font-size: 8pt">
                                                    <i class="fa fa-clock text-primary mr-1"></i>
                                                    {{ date('d-m-Y', strtotime($item->metadata_modified)) }}

                                                    <i class="fa fa-eye text-primary ml-4 mr-1"></i>
                                                    0

                                                    <i class="fa fa-download text-primary ml-4 mr-1"></i>
                                                    0
                                                </div>
                                                <div style="font-size: 12pt" class="mt-2">
                                                    @foreach ($item->resources as $resource)
                                                        <span class="badge badge-success mr-2">
                                                            {{ $resource->format }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </aside>

                            @if ($result['dataset'])
                                @php
                                    $nextpage = intval($result['page'])+1;
                                    $beforepage = intval($result['page'])-1;
                                @endphp
                                <!--pagination start-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <nav class="custom-pagination-nav mt-4">
                                            <ul class="pagination justify-content-center">
                                                <li class="page-item {{ $result['page'] == 1 ? 'disabled' : '' }}">
                                                    <a class="page-link" href="javascript:void(0);"
                                                    onclick="{{
                                                        $result['page'] == 1 ?
                                                        "javascript:void(0);"
                                                        :
                                                        "gotoPage(".$beforepage.")"
                                                    }}"
                                                    >
                                                        <span class="ti-angle-left"></span>
                                                    </a>
                                                </li>
                                                @for ($i = 1; $i <= $result['totalPage']; $i++)
                                                    @if ($i <= 1 || $i >= $result['totalPage'] - 1 || abs($i - $result['page']) <= 1)
                                                        @php
                                                            $outOfRange = false;
                                                        @endphp

                                                        <li class="page-item {{ $result['page'] == $i ? 'active' : '' }}">
                                                            <a class="page-link" href="javascript:void(0);" onclick="gotoPage({{ $i }})">
                                                                {{ $i }}
                                                            </a>
                                                        </li>
                                                    @else
                                                        @if (!$outOfRange)
                                                            <li class="page-item">
                                                                <a class="page-link" href="javascript:void(0);">...</a>
                                                            </li>
                                                        @endif
                                                        @php
                                                            $outOfRange = true;
                                                        @endphp
                                                    @endif
                                                @endfor
                                                <li
                                                    class="page-item {{ $result['page'] == $result['totalPage'] ? 'disabled' : '' }}">
                                                    <a class="page-link" href="javascript:void(0);"
                                                            onclick="{{
                                                                $result['page'] == $result['totalPage'] ?
                                                                "javascript:void(0);"
                                                                :
                                                                "gotoPage(".$nextpage.")"
                                                            }}"
                                                    >
                                                        <span class="ti-angle-right"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <!--pagination end-->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {

            $('.select2').select2({
                allowClear: true,
            }).on('select2:unselecting', function() {
                $(this).data('unselecting', true);
            }).on('select2:opening', function(e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                }
            });

            const url_string = window.location;
            const url = new URL(url_string);
            const opd = url.searchParams.get("pd");
            const group_id = url.searchParams.get("group_id");
            if(opd) $("#pd").val(opd).trigger('change');
            if(group_id) $("#group_id").val(group_id).trigger('change');

            var list = $(".list");
            if (list.height() > 380) {
                list.addClass("expand closed");
            }

            list.css("height", "auto");
            var listheight = list.css("height");
            list.css("height", "380px");

            $(".more-less").on("click", function() {
                list.toggleClass("open closed");
                if (list.hasClass("open")) {
                    list.height(listheight);
                }
                if (list.hasClass("closed")) {
                    list.height(380);
                }
            });

            $('#btn-filter-clear').on('click', function() {
                window.location.href = "{{ route('frontend.dataset.index') }}";
            });

            String.prototype.isEmpty = function() {
                return (this.length === 0 || !this.trim());
            };
        });

        function gotoPage(page) {
            $('#page').val(page);
            document.getElementById('form-filter').submit();
        }
    </script>
@endpush
