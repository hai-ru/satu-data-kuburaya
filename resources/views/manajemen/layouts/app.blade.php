<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | {{ $pageTitle ?? '' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ $metaDesc ?? config('app.description') }}" name="description" />
    <meta content="KJP0gEtTqQwamy4NEA1NrB/yWfnfJtMsUMgyIxwlXHY=" name="author" />
    <!-- App favicon -->
    {{-- <link rel="icon" href="{{ asset('frontend/img/logo-color.png') }}" type="image/png" sizes="16x16"> --}}
    {{-- <link rel="icon" href="{{ asset('frontend/img/logo-color.png') }}" type="image/png" sizes="16x16"> --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    @stack('styles')

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Custom Css-->
    <link href="{{ asset('assets/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body @yield('body')>
    @yield('wrapper')

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sweet Alerts js -->
    @include('sweetalert::alert')

    <!-- Flasher js -->
    <script src="{{ asset('assets/libs/flasher/flasher.min.js') }}"></script>

    @stack('scripts')

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
