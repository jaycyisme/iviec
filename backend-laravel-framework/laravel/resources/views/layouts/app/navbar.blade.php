<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="/" class="b-brand text-primary">
                <img src="https://hoanganhgaming.com/logo.png" alt="logo image" class="logo-lg" style="width:64px;" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Danh mục chính</label>
                </li>
                <li class="pc-item">
                    <a href="/" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-gauge"></i>
                        </span>
                        <span class="pc-mtext">Bảng điều khiển</span>
                    </a>
                </li>
                @role('Quản trị viên')
                <li class="pc-item pc-caption">
                    <label>Quản trị hệ thống</label>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-user-circle-gear"></i>
                        </span>
                        <span class="pc-mtext">Quyền và Vai trò</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('permissions.index') }}">Quyền</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('roles.index') }}">Vai trò</a></li>
                    </ul>
                </li>
                <li class="pc-item">
                    <a href="{{ route('users.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-user"></i>
                        </span>
                        <span class="pc-mtext">Người dùng</span>
                    </a>
                </li>
                @endrole
            </ul>
        </div>
        @if(Auth::check())
        <div class="card pc-user-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="user-avtar wid-45 rounded-circle" />
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="dropdown">
                            <a href="#" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,20">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 me-2">
                                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                        <small>{{ Auth::user()->roles->pluck('name')[0] ?? 'Thành viên' }}</small>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="btn btn-icon btn-link-secondary avtar">
                                            <i class="ph-duotone ph-windows-logo"></i>    
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <a class="pc-user-links" href="{{ route('profile.show') }}">
                                            <i class="ph-duotone ph-gear"></i>
                                            <span>Tài khoản</span>
                                        </a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <a class="pc-user-links" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                                <i class="ph-duotone ph-power"></i>
                                                <span>Đăng xuất</span>
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</nav>

<header class="pc-header">
    <div class="header-wrapper">
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="user-avtar" />
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0">Hồ sơ cá nhân</h5>
                        </div>
                        <div class="dropdown-body">
                            <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                                <ul class="list-group list-group-flush w-100">
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="wid-50 rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 mx-3">
                                                <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                                <a class="link-primary" href="{{ Auth::user()->email }}">{{ Auth::user()->email }}</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('profile.show') }}" class="dropdown-item">
                                            <span class="d-flex align-items-center">
                                                <i class="ph-duotone ph-user-circle"></i>
                                                <span>Quản lý Tài khoản</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                                <span class="d-flex align-items-center">
                                                    <i class="ph-duotone ph-power"></i>
                                                    <span>Đăng xuất</span>
                                                </span>
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>