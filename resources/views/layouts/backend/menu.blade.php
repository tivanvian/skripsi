<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="{{ route(defaultRoute()) }}" class="brand-wrap">
            <img src="{{asset('backend/assets/imgs/theme/BNI_logo.svg') }}" class="logo" alt="Nest Dashboard" />
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            {{-- <li class="menu-group">
                <span class="header">Dashboard</span>
            </li>
            <hr class="menu-group-line"/> --}}

            {!! \App\Models\User::menuRender() !!}

            {{-- <li class="menu-item active">
                <a class="menu-link" href="{{ route('admin.home') }}">
                    <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li> --}}

            {{-- @include('layouts.backend.menu.items') --}}
        </ul>
        <hr />
        {{-- <ul class="menu-aside">
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-settings"></i>
                    <span class="text">Settings</span>
                </a>
                <div class="submenu">
                    <a href="page-settings-1.html">Setting sample 1</a>
                    <a href="page-settings-2.html">Setting sample 2</a>
                </div>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="page-blank.html">
                    <i class="icon material-icons md-local_offer"></i>
                    <span class="text"> Starter page </span>
                </a>
            </li>
        </ul> --}}
        <br />
        <br />
    </nav>
</aside>
