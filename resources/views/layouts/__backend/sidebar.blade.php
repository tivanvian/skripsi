<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>

      {{-- Logo --}}
      <div class="logo-wrapper">
        <a href="{{url('/')}}">
          <img class="img-fluid for-light" src="{{ asset('themes/assets/images/logo/logo.png') }}" alt="">
          <img class="img-fluid for-dark" src="{{ asset('themes/assets/images/logo/logo_dark.png') }}" alt="">
        </a>
        <div class="back-btn">
          <i class="fa fa-angle-left"></i>
        </div>
        <div class="toggle-sidebar">
          <i class="status_toggle middle sidebar-toggle" data-feather="grid"></i>
        </div>
      </div>
      {{-- End Logo --}}

      {{-- Logo Icon Mobile --}}
      <div class="logo-icon-wrapper">
        <a href="{{url('/')}}">
          <img class="img-fluid" src="{{ asset('themes/assets/images/logo/logo-icon.png') }}" alt="">
        </a>
      </div>
      {{-- End Logo Icon Mobile --}}

      {{-- Sidebar Menu --}}
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow">
          <i data-feather="arrow-left"></i>
        </div>

        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">

            <li class="back-btn">
              <a href="{{url('/')}}">
                <img class="img-fluid" src="{{ asset('themes/assets/images/logo/logo-icon.png') }}" alt="">
              </a>
              <div class="mobile-back text-end">
                <span>Back</span>
                <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
              </div>
            </li>

            {{-- <li class="sidebar-main-title">
              <div>
                <h6 class="lan-1">General</h6>
              </div>
            </li>

            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title link-nav active" href="file-manager.html">
                <svg class="stroke-icon">
                  <use href="{{ asset('themes/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('themes/assets/svg/icon-sprite.svg#fill-home') }}"></use>
                </svg>
                <span>Dashboard</span>
              </a>
            </li>

            <li class="sidebar-main-title">
              <div>
                <h6 class="lan-8">Applications</h6>
              </div>
            </li>

            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title link-nav" href="file-manager.html">
                <svg class="stroke-icon">
                  <use href="{{ asset('themes/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('themes/assets/svg/icon-sprite.svg#fill-file') }}"></use>
                </svg>
                <span>File manager</span>
              </a>
            </li>

            <li class="sidebar-list">
              <label class="badge badge-light-danger">Latest</label>
              <a class="sidebar-link sidebar-title link-nav" href="kanban.html">
                <svg class="stroke-icon">
                  <use href="{{ asset('themes/assets/svg/icon-sprite.svg#stroke-board') }}"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('themes/assets/svg/icon-sprite.svg#fill-board') }}"></use>
                </svg>
                <span>kanban Board</span>
              </a>
            </li>

            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title" href="#">
                <svg class="stroke-icon">
                  <use href="{{ asset('themes/assets/svg/icon-sprite.svg#stroke-email') }}"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('themes/assets/svg/icon-sprite.svg#fill-email') }}"></use>
                </svg>
                <span>Email</span></a>
                <ul class="sidebar-submenu">
                  <li><a href="email-application.html">Email App</a></li>
                  <li><a href="email-compose.html">Email Compose</a></li>
              </ul>
            </li> --}}

            {!! \App\Zivar\Menu::Render() !!}
          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>
