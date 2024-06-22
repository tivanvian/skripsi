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
                        <img src="{{ asset('frontend/assets/imgs/theme/BNI_logo.svg') }}" class="logo" alt="BNI" />
                    </a>
                </div>
            </header>
            <section class="content-main mt-80">
                <div class="card mx-auto card-login">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Sign in</h4>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3">
                                <input placeholder="Username or email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" readonly required autocomplete="email" autofocus />
                            </div>
                            <!-- form-group// -->

                            <div class="mb-3">
                                <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
                            </div>

                            <div class="mb-3">
                                <input placeholder="Password" id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                            </div>

                            <!-- form-group form-check .// -->
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary w-100">Password</button>
                            </div>

                            <!-- form-group// -->
                        </form>
                    </div>
                </div>
            </section>
            <footer class="text-center">
                <p class="font-sm mb-0">&copy; 2022, <a href='https://innovated.co.id' target="_blank"><strong class="text-brand">InnovateD Indonesia</strong></a> - Sistem Informasi Katalog BNI <br />All rights reserved</p>
            </footer>
        </main>
        <script src="{{ asset('backend/assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/jquery.fullscreen.min.js') }}"></script>
        <!-- Main Script -->
        <script src="{{ asset('backend/assets/js/main.js?v=1.1') }}" type="text/javascript"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('vendor/izitoast/dist/js/iziToast.min.js') }}" type="text/javascript"></script>

        <script type="text/javascript">

            @if (session()->has('success'))
                @if(is_array(session('success')))
                    @foreach (session('success') as $success)
                        message = "{{ $success }}";
                    @endforeach
                @else
                    message = "{{ session('success') }}";
                @endif

                showToast('green', 'Success', message);
            @endif

            @if (session()->has('error'))
                @if(is_array(session('error')))
                    @foreach (session('error') as $error)
                        message = "{{ $error }}";
                    @endforeach
                @else
                    message = "{{ session('error') }}";
                @endif

                showToast('red', 'Error', message);
            @endif

            @if (session()->has('warning'))
                @if(is_array(session('warning')))
                    @foreach (session('warning') as $warning)
                        message = "{{ $warning }}";
                    @endforeach
                @else
                    message = "{{ session('warning') }}";
                @endif

                showToast('yellow', 'Warning', message);
            @endif

            @if (session()->has('info'))
                @if(is_array(session('info')))
                    @foreach (session('info') as $info)
                        message = "{{ $info }}";
                    @endforeach
                @else
                    message = "{{ session('info') }}";
                @endif

                showToast('blue', 'Info', message);
            @endif

            @if ($errors->any())
                @if(is_array($errors->all()))
                    @foreach ($errors->all() as $error)
                        showToast('red', 'Error', "{{ $error }}");
                    @endforeach
                @else
                    showToast('red', 'Error', "{{ $errors->all() }}");
                @endif
            @endif

            function showToast(type, title, message, position = 'topRight') {
                iziToast.show({
                    timeout: 5000,
                    resetOnHover: true,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    color: type, // blue, red, green, yellow
                    position: position, // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                    title: title,
                    message: message
                });
            }

            $(function () {

            });
        </script>
    </body>
</html>
