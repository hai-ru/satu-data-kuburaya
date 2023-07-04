<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li class="{{ Route::is('dashboard') ? 'mm-active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="waves-effect {{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                @can('dataset-browse')
                    <li class="{{ Request::is('dashboard/dataset*') ? 'mm-active' : '' }}">
                        <a href="{{ route('dataset.index') }}"
                            class="waves-effect {{ Request::is('dashboard/dataset*') ? 'active' : '' }}">
                            <i class="bx bx-file"></i>
                            <span key="t-dataset">Dataset</span>
                        </a>
                    </li>
                @endcan

                {{-- @can('target-capaian-browse')
                    <li>
                        <a href="#" class="waves-effect">
                            <i class="bx bx-chart"></i>
                            <span key="t-target">Capaian Target</span>
                        </a>
                    </li>
                @endcan --}}

                @can('infografik-browse')
                    <li class="{{ Request::is('dashboard/infografik*') ? 'mm-active' : '' }}">
                        <a href="{{ route('infografik.index') }}"
                            class="waves-effect {{ Request::is('dashboard/infografik*') ? 'active' : '' }}">
                            <i class="bx bx-line-chart"></i>
                            <span key="t-infografik">Infografik</span>
                        </a>
                    </li>
                @endcan

                @can('slider-browse')
                    <li class="{{ Request::is('dashboard/slider*') ? 'mm-active' : '' }}">
                        <a href="{{ route('slider.index') }}"
                            class="waves-effect {{ Request::is('dashboard/slider*') ? 'active' : '' }}">
                            <i class="bx bx-image"></i>
                            <span key="t-slider">Slider</span>
                        </a>
                    </li>
                @endcan

                @can('testimoni-browse')
                    <li class="{{ Request::is('dashboard/testimoni*') ? 'mm-active' : '' }}">
                        <a href="{{ route('testimoni.index') }}"
                            class="waves-effect {{ Request::is('dashboard/testimoni*') ? 'active' : '' }}">
                            <i class="bx bx-comment"></i>
                            <span key="t-testimoni">Testimoni</span>
                        </a>
                    </li>
                @endcan

                @can('unduhan-browse')
                    <li class="{{ Request::is('dashboard/unduhan*') ? 'mm-active' : '' }}">
                        <a href="{{ route('unduhan.index') }}"
                            class="waves-effect {{ Request::is('dashboard/unduhan*') ? 'active' : '' }}">
                            <i class="bx bx-download"></i>
                            <span key="t-download">Unduhan</span>
                        </a>
                    </li>
                @endcan

                @can('perangkat-daerah-browse')
                    <li>
                        <a href="#" class="waves-effect">
                            <i class="bx bx-download"></i>
                            <span key="t-opd">Perangkat Daerah</span>
                        </a>
                    </li>
                @endcan

                @hasanyrole('masteradmin|superadmin')
                    @if (auth()->user()->hasAnyPermission(['roles-browse', 'permissions-browse', 'users-browse']))
                        <!-- Manajemen User -->
                        <li class="menu-title" key="t-menu">Manajemen User</li>
                        @can('roles-browse')
                            <li class="{{ Request::is('dashboard/roles*') ? 'mm-active' : '' }}">
                                <a href="{{ route('roles.index') }}"
                                    class="waves-effect {{ Request::is('dashboard/roles*') ? 'active' : '' }}">
                                    <i class="bx bx-group"></i>
                                    <span key="t-roles">Peran</span>
                                </a>
                            </li>
                        @endcan
                        @can('permissions-browse')
                            <li class="{{ Request::is('dashboard/permissions*') ? 'mm-active' : '' }}">
                                <a href="{{ route('permissions.index') }}"
                                    class="waves-effect {{ Request::is('dashboard/permissions*') ? 'active' : '' }}">
                                    <i class="bx bxs-key"></i>
                                    <span key="t-permissions">Hak Akses</span>
                                </a>
                            </li>
                        @endcan
                        @can('users-browse')
                            <li class="{{ Request::is('dashboard/users*') ? 'mm-active' : '' }}">
                                <a href="{{ route('users.index') }}"
                                    class="waves-effect {{ Request::is('dashboard/users*') ? 'active' : '' }}">
                                    <i class="bx bx-user"></i>
                                    <span key="t-users">User</span>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endhasanyrole
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
