@extends('frontend.layouts.app')

@push('styles')
    <style>
        #container_head {
            z-index: 1;
        }
    </style>
@endpush

@section('content')
    <!--hero section start-->
    @if (isset($slider) && $slider->count() > 0)
        <section class="pb-5" style="margin-bottom: 70px">
            <div class="view-slider-image">
                <div id="carouselHeader" class="owl-carousel owl-header owl-theme">
                    @foreach ($slider as $item)
                        <div class="item">
                            <img src="{{ url('uploads/slider/' . $item->gambar) }}" alt="{{ $item->judul }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="hero-equal-height pt-165 pb-100 gradient-bg" style="margin-bottom: 100px">
            <img src="{{ asset('frontend/img/grop-shape-3.svg') }}" alt="group shape" class="group-shape-1">
            <img src="{{ asset('frontend/img/grop-shape-2.svg') }}" alt="group shape" class="group-shape-2">
            <div class="container mb-5" id="container_head">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="section-heading text-center mb-4">
                            <h2 class="text-white">Satu Data Terintegrasi Kuburaya</h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="gray-light-bg shadow-sm p-4 p-md-5 rounded">
                            <div class="h5">
                                Anda bisa akses koleksi dataset dengan cepat, mudah, dan akurat dibantu berbagai fitur
                                bermanfaat.
                            </div>
                            <aside class="widget widget-search mt-4 mb-2">
                                <form id="form-filter" method="GET" action="{{ route('frontend.dataset.index') }}">
                                    <input class="form-control" id="cari" name="cari"
                                        placeholder="Cari Dataset">
                                    <button class="search-button" type="submit"><span
                                            class="ti-search"></span></button>
                                </form>
                                <small id="search-warning" class="text-danger d-none">
                                    Silahkan isi dengan keyword yang ingin Anda cari.
                                </small>
                            </aside>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="single-counter gray-light-bg shadow-sm p-4 rounded text-center border-0">
                                    <p class="text-left three-lines-words">
                                        Kumpulan data-data mentah berupa tabel yang dapat diolah lebih lanjut.
                                    </p>
                                    <h2 class="mb-0">{{ $total_dataset - 1 }}</h2>
                                    <p>Total Dataset</p>
                                    <a href="{{ route('frontend.dataset.index') }}"
                                        class="btn secondary-solid-btn">Selengkapnya
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-counter gray-light-bg shadow-sm p-4 rounded text-center border-0">
                                    <p class="text-left three-lines-words">
                                        Informasi yang disajikan dalam bentuk grafik agar lebih mudah dipahami.
                                    </p>
                                    <h2 class="mb-0">{{ $infografik->count() }}</h3>
                                        <p>Total Visualisasi</p>
                                        <a href="{{ route('frontend.infografik.index') }}"
                                            class="btn secondary-solid-btn">Selengkapnya</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-counter gray-light-bg shadow-sm p-4 rounded text-center border-0">
                                    <p class="text-left three-lines-words">
                                        Organisasi Perangkat Daerah yang publikasi datanya tampil di Satu Data Kota Pontianak.
                                    </p>
                                    <h2 class="mb-0">{{ $total_opd }}</h2>
                                    <p>Total OPD</p>
                                    <a href="{{ route('frontend.opd') }}" class="btn secondary-solid-btn">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="{{ asset('frontend/img/combined-shape.svg') }}" alt="s" class="shape-img-2">
            <div class="hero-bottom-shape"
                style="background: url('{{ asset('frontend/img/hero-bottom-shape-2.svg') }}')no-repeat bottom center"></div>
        </section>
    @endif
    <!--hero section end-->

    @if (count($kategori) > 0)
        <!--promo block with hover effect start-->
        <section class="promo-block ptb-100 gray-light-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="section-heading text-center mb-5">
                            <h2>Kategori Data</h2>
                            <p class="lead">
                                Mulai jelajahi {{ count($kategori) }} kategori yang dapat memenuhi kebutuhan informasimu
                                saat ini
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($kategori as $item)
                        <div class="col-6 col-md-4 col-lg-4 mb-4 text-center">
                            <a href="{{ route('frontend.dataset.index', ["group_id=$item->name"]) }}">
                                <div class="single-promo-block promo-hover-bg-1 hover-image shadow-lg p-5 rounded">
                                    <img src="{{ $item->image_display_url ? $item->image_display_url : asset('frontend/img/data-analytics.svg') }}"
                                        alt="{{ $item->display_name }}" class="mb-3" height="100">
                                    <div class="promo-block-content">
                                        <h5>{{ ucfirst($item->display_name) }}</h5>
                                        <p>{{ $item->package_count - 1 }} Dataset</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--promo block with hover effect end-->
    @endif

    <!--statistic section start-->
    {{-- <section class="statistic-section mt-5 mb-5">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-8">
                    <div class="section-heading mb-5 text-center">
                        <h2>Statistik Pengunjung</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">

                </div>
            </div>
        </div>
    </section> --}}
    <!--statistic section end-->

    <!--testimonial section start-->
    <section class="testimonial-section mt-5 mb-5">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-8">
                    <div class="section-heading mb-5 text-center">
                        <h2>Testimoni</h2>
                        <p class="lead">
                            Testimoni terhadap data yang disajikan<br>
                            dan kemudahan dalam penggunaan website
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    @if ($testimoni->count() > 0)
                        <div class="owl-carousel owl-theme link-testimonial custom-arrow custom-arrow-bottom-center mb-5">
                            @foreach ($testimoni as $item)
                                <div class="item">
                                    <div class="testimonial-single shadow-sm gray-light-bg rounded p-4 text-left">
                                        <blockquote class="four-lines-words">
                                            {{ $item->testimoni }} {{ $item->rating <= 2 }}
                                        </blockquote>
                                        <div class="link-ratting mt-2">
                                            <ul class="list-inline link-ratting-list">
                                                @if ($item->rating >= 1)
                                                    <li class="list-inline-item">
                                                        <span class="fas fa-star ratting-color"></span>
                                                    </li>
                                                @endif
                                                @if ($item->rating >= 2)
                                                    <li class="list-inline-item">
                                                        <span class="fas fa-star ratting-color"></span>
                                                    </li>
                                                @endif
                                                @if ($item->rating >= 3)
                                                    <li class="list-inline-item">
                                                        <span class="fas fa-star ratting-color"></span>
                                                    </li>
                                                @endif
                                                @if ($item->rating >= 4)
                                                    <li class="list-inline-item">
                                                        <span class="fas fa-star ratting-color"></span>
                                                    </li>
                                                @endif
                                                @if ($item->rating >= 5)
                                                    <li class="list-inline-item">
                                                        <span class="fas fa-star ratting-color"></span>
                                                    </li>
                                                @endif
                                            </ul>
                                            <h6 class="font-weight-bold">Rating: {{ $item->rating }}</h6>
                                        </div>
                                    </div>
                                    <div class="link-info-wrap d-flex align-items-center mt-5">
                                        <div class="link-info">
                                            <h5 class="mb-0">{{ $item->nama }}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <button class="btn outline-btn {{ $testimoni->count() > 0 ? 'mt-5' : '' }}" id="btn-testimoni">
                Berikan Testimoni <span class="ti-comment-alt pl-2"></span>
            </button>
        </div>
    </section>
    <!--testimonial section end-->

    <!--link section start-->
    {{-- <div class="link-section ptb-100 gray-light-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-8">
                    <div class="section-heading mb-3 text-center">
                        <h2>Link Terkait</h2>
                    </div>
                </div>
            </div>
            <!--link logo start-->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme links-carousel dot-indicator">
                        <div class="item single-link" style="height: 150px !important">
                            <a href="https://opendata.pontianak.go.id" target="_blank">
                                <img src="{{ asset('frontend/img/link-terkait/logo-opendata.png') }}" alt="link logo"
                                    class="link-img">
                            </a>
                        </div>
                        <div class="item single-link" style="height: 150px !important">
                            <a href="https://jepin.pontianak.go.id" target="_blank">
                                <img src="{{ asset('frontend/img/link-terkait/logo-jepin.png') }}" alt="link logo"
                                    class="link-img">
                            </a>
                        </div>
                        <div class="item single-link" style="height: 150px !important">
                            <a href="https://ppid.pontianak.go.id" target="_blank">
                                <img src="{{ asset('frontend/img/link-terkait/logo-ppid.png') }}" alt="link logo"
                                    class="link-img">
                            </a>
                        </div>
                        <div class="item single-link" style="height: 150px !important">
                            <a href="http://pontianakkota.ina-sdi.or.id/" target="_blank">
                                <img src="{{ asset('frontend/img/link-terkait/logo-geospatial.png') }}" alt="link logo"
                                    class="link-img">
                            </a>
                        </div>
                        <div class="item single-link" style="height: 150px !important">
                            <a href="https://siappintas.pontianak.go.id" target="_blank">
                                <img src="{{ asset('frontend/img/link-terkait/logo-siap-pintas.png') }}" alt="link logo"
                                    class="link-img">
                            </a>
                        </div>
                        <div class="item single-link" style="height: 150px !important">
                            <a href="https://gertak.pontianak.go.id" target="_blank">
                                <img src="{{ asset('frontend/img/link-terkait/logo-webgis-gertak.png') }}"
                                    alt="link logo" class="link-img">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--link logo end-->
        </div>
    </div> --}}
    <!--link section start-->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}">
    <style>
        .owl-stage {
            margin: 0 auto;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(function() {
            $('#carouselHeader').owlCarousel({
                loop: true,
                margin: 0,
                items: 1,
                nav: false,
                dots: false,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 8000,
                autoplayHoverPause: true,
                autoplaySpeed: 2000,
                lazyLoad: true,
            });

            $('#form-filter').submit(function() {
                if ($('#cari').val() === "") {
                    $('#search-warning').removeClass('d-none')
                    return false;
                }
            });

            $('#btn-testimoni').on('click', function() {
                Swal.fire({
                    title: 'Testimoni Form',
                    html: `<div id="full-stars-example-two">
                                <div class="rating-group">
                                    <input disabled checked class="rating__input rating__input--none" name="rating" id="rating-none" value="0" type="radio">
                                    <label aria-label="1 star" class="rating__label" for="rating-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating" id="rating-1" value="1" type="radio">
                                    <label aria-label="2 stars" class="rating__label" for="rating-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating" id="rating-2" value="2" type="radio">
                                    <label aria-label="3 stars" class="rating__label" for="rating-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating" id="rating-3" value="3" type="radio">
                                    <label aria-label="4 stars" class="rating__label" for="rating-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating" id="rating-4" value="4" type="radio">
                                    <label aria-label="5 stars" class="rating__label" for="rating-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating" id="rating-5" value="5" type="radio">
                                </div>
                            </div>
                            <input type="text" id="nama" class="swal2-input" placeholder="Nama Lengkap">
                            <input type="text" id="email" class="swal2-input" placeholder="Email">
                            <textarea id="testimoni" class="swal2-textarea" rows="10" placeholder="Isi testimoni Anda">`,
                    confirmButtonText: 'Berikan Testimoni',
                    focusConfirm: false,
                    preConfirm: () => {
                        const rating = Swal.getPopup().querySelector(
                            'input[name="rating"]:checked').value;
                        const nama = Swal.getPopup().querySelector('#nama').value;
                        const email = Swal.getPopup().querySelector('#email').value;
                        const testimoni = Swal.getPopup().querySelector('#testimoni').value;

                        if (!nama || !email || !testimoni) {
                            Swal.showValidationMessage(`Silakan lengkapi semua kolom di atas!`)
                        } else {
                            if (!validateEmail(email)) {
                                Swal.showValidationMessage(`Format email tidak valid!`)
                            } else {
                                if (rating == 0) {
                                    Swal.showValidationMessage(
                                        `Silakan berikan rating pada tombool bintang!`)
                                }
                            }
                        }

                        return {
                            rating: rating,
                            nama: nama,
                            email: email,
                            testimoni: testimoni
                        }
                    }
                }).then((result) => {
                    if ('value' in result) {
                        $.ajax({
                            url: "{{ route('ajax.testimoni.store') }}",
                            type: 'POST',
                            data: {
                                rating: result.value.rating,
                                nama: result.value.nama,
                                email: result.value.email,
                                testimoni: result.value.testimoni,
                            },
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function(result) {
                                let alertType
                                if (result.status == true) {
                                    alertType = 'success';
                                } else {
                                    alertType = 'error';
                                }

                                Swal.fire({
                                    title: 'Testimoni',
                                    text: result.message,
                                    icon: alertType,
                                    allowOutsideClick: true,
                                });
                            },
                        });
                    }
                });
            });
        });

        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }
    </script>
@endpush
