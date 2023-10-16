<!--header section start-->
<header class="header">
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg fixed-top bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                {{-- <img src="{{ asset('frontend/img/logo-color-border.png') }}" alt="logo" class="img-fluid" style="height: 70px" /> --}}
                <img src="https://opendata.kuburayakab.go.id/uploads/admin/2022-10-13-024032.801264opendata.png" alt="logo" class="img-fluid" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-menu"></span>
            </button>
            <div class="collapse navbar-collapse h-auto" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto menu">
                    <li><a href="{{ route('frontend.home') }}">Beranda</a></li>
                    <li><a href="{{ route('frontend.dataset.index') }}">Dataset</a></li>
                    <li><a href="{{ route('frontend.opd') }}">Perangkat Daerah</a></li>
                    <li><a href="{{ route('frontend.infografik.index') }}">Visualisasi</a></li>
                    {{-- <li><a href="{{ route('frontend.infografik.index') }}">Infografik</a></li> --}}
                </ul>
            </div>
        </div>
    </nav>
</header>
<!--header section end-->