@extends('manajemen.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-3">
            @role('perangkat-daerah')
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4 text-center">Target Capaian</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mt-4 mt-sm-0">
                                    <div id="radialBar-chart" data-colors='["--bs-primary"]' class="apex-charts"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4 text-center">
                                <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">
                                    Lihat daftar target capaian
                                    <i class="mdi mdi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>
        <div class="col-sm-12 col-md-9">
            @hasanyrole('masteradmin|superadmin|walidata')
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Dataset</p>
                                        <h4 class="mb-0">4703</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="bx bx-copy-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Perangkat Daerah</p>
                                        <h4 class="mb-0">31</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center ">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-building font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Kategori</p>
                                        <h4 class="mb-0">9</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            @endhasanyrole
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
