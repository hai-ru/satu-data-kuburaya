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
                        <h4 class="text-white mb-0">{{ $dataset->title }}</h4>
                        <div class="custom-breadcrumb">
                            <div style="font-size: 10pt">
                                <i class="fa fa-building mr-1"></i>
                                {{ $dataset->organization->title }}
                            </div>
                            <div style="font-size: 10pt">
                                <i class="fa fa-clock mr-1"></i>
                                {{ date('d-m-Y', strtotime(last($dataset->resources)->last_modified)) }}

                                <i class="fa fa-eye ml-4 mr-1"></i>
                                0

                                <i class="fa fa-download ml-4 mr-1"></i>
                                0
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header section end-->

    <section class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Deskripsi Dataset</strong>
                        </div>
                        <div class="card-body">
                            {{ $dataset->notes }}

                            <div>
                                <div class="row form-group mt-3">
                                    <label class="col-sm-12 col-md-4 form-label font-weight-bolder">
                                        Perangkat Daerah
                                    </label>
                                    <div class="col-sm-12 col-md-8">
                                        {!! Form::text('organization', $dataset->organization->title, [
                                            'class' => 'form-control',
                                            'style' => 'height: 2.5em;',
                                            'disabled' => 'disabled',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="row form-group mt-3">
                                    <label class="col-sm-12 col-md-4 form-label font-weight-bolder">
                                        Pembuat
                                    </label>
                                    <div class="col-sm-12 col-md-8">
                                        {!! Form::text('author', $dataset?->author ?? '-', [
                                            'class' => 'form-control',
                                            'style' => 'height: 2.5em;',
                                            'disabled' => 'disabled',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="row form-group mt-3">
                                    <label class="col-sm-12 col-md-4 form-label font-weight-bolder">
                                        Dibuat
                                    </label>
                                    <div class="col-sm-12 col-md-8">
                                        {!! Form::text('created', date('d-m-Y', strtotime($dataset->metadata_created)), [
                                            'class' => 'form-control',
                                            'style' => 'height: 2.5em;',
                                            'disabled' => 'disabled',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="row form-group mt-3">
                                    <label class="col-sm-12 col-md-4 form-label font-weight-bolder">
                                        Diperbaharui
                                    </label>
                                    <div class="col-sm-12 col-md-8">
                                        {!! Form::text('modified', date('d-m-Y', strtotime($dataset->metadata_modified)), [
                                            'class' => 'form-control',
                                            'style' => 'height: 2.5em;',
                                            'disabled' => 'disabled',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="row form-group mt-3">
                                    <label class="col-sm-12 col-md-4 form-label font-weight-bolder">
                                        Tag
                                    </label>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="tag-cloud">
                                            @foreach ($dataset->tags as $item)
                                                <a href="javascript:void(0)">
                                                    {{ $item->display_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <h5>File Resource</h5>
                                <ul class="resource-info-list">
                                    @foreach ($dataset->resources as $item)
                                        <li class="mb-3 p-2 rounded">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-9" style="margin-bottom: 0px !important">
                                                    <div class="mb-2 text-dark font-weight-bold" style="font-size: 14pt">
                                                        {{ $item->name }}</div>
                                                    <div style="font-size: 10pt">
                                                        <i class="fa fa-clock mr-1"></i>
                                                        {{ date('d-m-Y', strtotime($item->last_modified)) }}

                                                        <i class="fa fa-eye ml-4 mr-1"></i>
                                                        0

                                                        <i class="fa fa-download ml-4 mr-1"></i>
                                                        0
                                                    </div>
                                                </div>
                                                @php
                                                    switch (strtolower($item->format)) {
                                                        case 'csv':
                                                            $src = "https://view.officeapps.live.com/op/view.aspx?src=$item->url";
                                                            break;
                                                        case 'xlsx':
                                                            $src = "https://view.officeapps.live.com/op/view.aspx?src=$item->url";
                                                            break;
                                                        case 'xls':
                                                            $src = "https://view.officeapps.live.com/op/view.aspx?src=$item->url";
                                                            break;
                                                        default:
                                                            $src = $item->url;
                                                            break;
                                                    }
                                                @endphp
                                                <div class="col-sm-12 col-md-3 text-right">
                                                    <a data-fancybox="" data-type="iframe"
                                                        class="btn secondary-solid-btn mt-4 full-width fancyb"
                                                        data-src="{{ $src }}"
                                                        href="javascript:void(0);">Pratinjau</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>Formulir Pemanfaatan Data</strong>
                        </div>
                        <div class="card-body">
                            <p class="alert alert-info" style="font-size: 10pt;">
                                Data Anda akan dijaga kerahasiaannya dan tidak akan digunakan
                                di luar kepentingan analisa dari Pemerintah Kubu Raya
                            </p>
                            <form action="#" method="POST" id="contactForm1" class="contact-us-form"
                                novalidate="novalidate">
                                <div class="form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            {!! Form::text('nama', null, [
                                                'id' => 'nama',
                                                'class' => 'form-control',
                                                'placeholder' => 'Nama Lengkap',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            {!! Form::text('email', null, [
                                                'id' => 'email',
                                                'class' => 'form-control',
                                                'placeholder' => 'Email Lengkap',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea name="message" id="message" class="form-control" rows="7" cols="25"
                                                placeholder="Isi dengan jelas alasan pemanfaatan dataset ini"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-3">
                                        <button type="submit" class="btn secondary-solid-btn w-100">
                                            <i class="fa fa-download"></i> Unduh
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/fancybox.css') }}">
    <style>
        .resource-info-list li a {
            color: #ffffff !important;
        }
        .resource-info-list li a:hover {
            color: #1351a8 !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('frontend/js/fancybox.umd.js') }}"></script>
@endpush
