@extends('frontend.layouts.base')

@section('main-content')
    @include('frontend.layouts.header')

    <!--body content wrap start-->
    <div class="main">
        @yield('content')
    </div>
    <!--body content wrap end-->


    @include('frontend.layouts.footer')
@endsection
