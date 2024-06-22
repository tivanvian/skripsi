<div class="page-header">
    <div class="header-wrapper row m-0">

      {{-- @include('layouts.__backend.addons.typehead') --}}

      <div class="header-logo-wrapper col-auto p-0">
        <div class="logo-wrapper">
          <a href="{{ url('/') }}">
            <img class="img-fluid" src="{{ asset('themes/assets/images/logo/logo.png') }}" alt="">
          </a>
        </div>
        <div class="toggle-sidebar">
          <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
        </div>
      </div>

      {{-- @include('layouts.__backend.addons.change-role') --}}

      {{-- @include('layouts.__backend.addons.notifications-slider') --}}

      <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
        <ul class="nav-menus">

            @include('layouts.__backend.nav-menus.change-role')

            @include('layouts.__backend.nav-menus.language')

            {{-- @include('layouts.__backend.nav-menus.typehead-search') --}}

            {{-- @include('layouts.__backend.nav-menus.bookmarks') --}}

            @include('layouts.__backend.nav-menus.change-mode')

            {{-- @include('layouts.__backend.nav-menus.notifications') --}}

            @include('layouts.__backend.nav-menus.account')
        </ul>
      </div>

      @include('layouts.__backend.nav-menus.typehead-script')

    </div>
  </div>
