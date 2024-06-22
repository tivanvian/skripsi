<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Zivar Core V1">
    <meta name="keywords" content="zivar, core, zivar core, zivar-core, zivar_core">
    <meta name="author" content="Zivar">

    <title>{{ config('app.name') }} @yield('page-title-bar')</title>

    @include('layouts.__backend.partials.icon')

    @include('layouts.__backend.partials.font')

    @include('layouts.__backend.partials.styles')

    @include('layouts.__backend.partials.custom-styles')
  </head>

  {{-- <body onload="startTime()"> --}}
  <body>

    @include('layouts.__backend.preloader')

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">

      <!-- Page Header Start-->
      @include('layouts.__backend.header')
      <!-- Page Header Ends -->

      <!-- Page Body Start-->
      <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('layouts.__backend.sidebar')
        <!-- Page Sidebar Ends-->

        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>@yield('page-title', $page['page-title'] ?? 'Zivar')</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="{{ url('/') }}">
                        <svg class="stroke-icon">
                          <use href="{{ asset('themes/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                        </svg>
                      </a>
                    </li>
                    @yield('page-breadcrumb', $page['page-breadcrumb'] ?? '')
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">

            @hasSection('page-content')
                @yield('page-content')
            @endif

            @hasSection('page-content__body')
                <div class="row project-cards">
                    @hasSection('page-content__header')
                        <div class="col-md-12 project-list">
                            <div class="card">
                                @yield('page-content__header')
                            </div>
                        </div>
                    @endif

                    @yield('page-content__body')

                    {{-- <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                @yield('page-content__body')
                            </div>
                        </div>
                    </div> --}}
                </div>
            @endif
          </div>
          <!-- Container-fluid Ends-->
        </div>

        @include('layouts.__backend.footer')
      </div>
    </div>

    @include('layouts.__backend.partials.scripts')

    @include('layouts.__backend.partials.custom-scripts')

  </body>
</html>
