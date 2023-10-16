<!-- ========== Header ========== -->
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" id="navbar_box">
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img 
                            {{-- src="{{ asset('frontend/img/logo-color.png') }}" --}}
                            src="https://opendata.kuburayakab.go.id/uploads/admin/2022-10-13-024032.801264opendata.png"
                            alt="{{ config('app.name') }}" class="img-fluid">
                    </span>
                    <span class="logo-lg">
                        {{-- <img src="{{ asset('frontend/img/logo-color.png') }}"
                            alt="{{ config('app.name') }}" width="60"> --}}
                        <img 
                        {{-- src="{{ asset('frontend/img/logo-color.png') }}" --}}
                        src="https://opendata.kuburayakab.go.id/uploads/admin/2022-10-13-024032.801264opendata.png"
                        alt="{{ config('app.name') }}" class="img-fluid">
                    </span>
                </a>
            </div>

            <button type="button"
                class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                id="vertical-menu-btn" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/user.png') }}"
                        alt="avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-user">{{ auth()->user()->username }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#">
                        <i class="bx bx-user font-size-16 align-middle me-1"></i>
                        <span key="t-profile">Profil</span>
                    </a>
                    <a class="dropdown-item d-block" href="#">
                        <i class="bx bx-wrench font-size-16 align-middle me-1"></i>
                        <span key="t-settings">Pengaturan</span>
                    </a>
                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                        <span key="t-logout">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
