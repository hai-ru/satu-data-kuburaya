@extends('frontend.layouts.app')

@section('main-content')
    <!--hero section start-->
    <section class="hero-section full-screen gray-light-bg">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">

                <div class="col-12 col-md-7 col-lg-6 col-xl-8 d-none d-lg-block">
                    <!-- Image -->
                    <div class="bg-cover vh-100 ml-n3 gradient-overlay"
                        style="background-image: url({{ asset('frontend/img/slider-img-1.jpg') }});">
                        <div class="position-absolute login-signup-content">
                            <div class="position-relative text-white col-md-12 col-lg-7">
                                <h2 class="text-white">{{ config('app.name') }}</h2>
                                <p>{{ env('APP_DESC') }}</p>
                                {{-- <p>
                                    Data terbuka adalah suatu konsep tentang data yang tersedia secara bebas untuk diakses
                                    dan dimanfaatkan oleh masyarakat. Konsep ini serupa dengan konsep-konsep terbuka
                                    lainnya, seperti sumber terbuka, pemerintahan terbuka, dan Universitas Terbuka.
                                </p> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="login-signup-wrap px-4 px-lg-5 my-5">
                        <!-- Heading -->
                        <h1 class="text-center mb-1">
                            Login
                        </h1>
                        <p class="text-center mb-5">
                            Silakan masuk dengan menggunakan username dan password Anda.
                        </p>

                        @if ($errors->any())
                            <div class="alert alert-danger fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <p class="mb-2">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <!--login form-->
                        <form class="login-signup-form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="pb-1">Username</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-user"></span>
                                    </div>
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username Anda">
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label class="pb-1">Password</label>
                                    </div>
                                </div>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-lock"></span>
                                    </div>
                                    <input type="password" class="form-control" name="password" placeholder="Password Anda">
                                </div>
                            </div>

                            <!-- Submit -->
                            <button class="btn btn-block secondary-solid-btn border-radius mt-4 mb-3">
                                Masuk
                            </button>
                        </form>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div>
    </section>
    <!--hero section end-->
    {{-- <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft p-4 text-center">
                            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="{{ config('app.name') }}"
                                style="width: 200px;">
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2 mt-4">
                                @if ($errors->any())
                                    <div class="alert alert-danger fade show" role="alert">
                                        <h5>Terjadi Kesalahan</h5>
                                        @foreach ($errors->all() as $error)
                                            <p class="mb-2">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                <form class="form-horizontal" action="{{ url('/login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username"
                                            placeholder="Enter username" name="username" value="{{ old('username') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Enter password" aria-label="Password"
                                                aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i
                                                    class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">
                                            Ingat saya
                                        </label>
                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light"
                                            type="submit">Masuk</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center text-white">
                        <div>
                            <p>{{ now()->year }} © {{ isset($hotelInfo) ? $hotelInfo->nm_hotel : config('app.name') }} -
                                v{{ config('app.version') }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}
@endsection
