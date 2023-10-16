@extends('frontend.layouts.app')

@section('content')
    <section class="ptb-100">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-heading mb-5">
                        <h1>404</h1>
                        <h3>
                            Maaf, kami tidak dapat menemukan halaman yang Anda cari. 
                        </h3>
                        <p class="lead">
                            Periksa kembali alamat URL yang Anda masukkan apakah sudah benar? 
                            Pastikan kembali untuk memeriksa ejaan Anda. Atau cari dataset yang ingin Anda temukan.
                        </p>
                    </div>

                    <div class="gray-light-bg shadow-sm p-3 rounded">
                        <aside class="widget widget-search mb-2">
                            <form id="form-filter" method="GET" action="{{ route('frontend.dataset.index') }}">
                                <input class="form-control" id="cari" name="cari" placeholder="Cari Dataset">
                                <button class="search-button" type="submit"><span
                                        class="ti-search"></span></button>
                            </form>
                            <small id="search-warning" class="text-danger d-none">
                                Silahkan isi dengan keyword yang ingin Anda cari.
                            </small>
                        </aside>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('frontend.home') }}" class="btn secondary-solid-btn mt-3 full-width">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(function() {
            $('#form-filter').submit(function() {
                if ($('#cari').val() === "") {
                    $('#search-warning').removeClass('d-none')
                    return false;
                }
            });
        });
    </script>
@endpush