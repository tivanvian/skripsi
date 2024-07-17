<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ config('app.name') }} | Login</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/imgs/theme/favicon_152x152.png') }}" />
        <!-- Template CSS -->
        <link href="{{ asset('backend/assets/css/main.css?v=1.1') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{asset('vendor/izitoast/dist/css/iziToast.min.css') }}">
    </head>

    <body>
        <main>
            <header class="main-header style-2 navbar">
                <div class="col-brand">
                    <a href="{{ route('index') }}" class="brand-wrap text-center">
                        <img src="{{ asset('frontend/assets/imgs/theme/BNI_logo.svg') }}" class="logo" alt="ZIVAR" />
                    </a>
                </div>
            </header>
            <section class="content-main mt-80">
                <div class="card mx-auto card-login">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <input placeholder="Username or email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </section>
            <footer class="text-center">
                <p class="font-sm mb-0">&copy; 2022, <a href='https://innovated.co.id' target="_blank"><strong class="text-brand">InnovateD Indonesia</strong></a> - Sistem Informasi Katalog ZIVAR <br />All rights reserved</p>
            </footer>
        </main>
        <script src="{{ asset('backend/assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/jquery.fullscreen.min.js') }}"></script>
        <!-- Main Script -->
        <script src="{{ asset('backend/assets/js/main.js?v=1.1') }}" type="text/javascript"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('vendor/izitoast/dist/js/iziToast.min.js') }}" type="text/javascript"></script>
    </body>
</html>
