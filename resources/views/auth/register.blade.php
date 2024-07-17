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
            <section class="content-main mt-30">
                <div class="card mx-auto card-register">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Sign up</h4>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <input placeholder="NIK" id="nik" type="nik" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus />
                                </div>
                                <div class="col-md-6">
                                    <input placeholder="NPP" id="npp" type="npp" class="form-control @error('npp') is-invalid @enderror" name="npp" value="{{ old('npp') }}" required autocomplete="npp" autofocus />
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row no-resource">
                                    <div class="col-lg-12">
                                        <div class="custom_select">
                                            <select id="branch_id" class="form-control branch_id select2Form" name="branch_id" required>
                                                <option value="">-- Pilih Cabang --</option>
                                                @foreach (\App\Models\Branch::whereIsActive(true)->get() as $item)
                                                    <option value="{{ $item["id"] }}" @if(old('branch_id') && old('branch_id') == $item['id']) selected @endif>{{ $item["name"] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <input placeholder="Phone" id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus />
                            </div>


                            <div class="mb-3">
                                <input placeholder="Name" id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                            </div>


                            <div class="mb-3">
                                <input placeholder="Username or email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            </div>

                            <!-- form-group// -->

                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
                                </div>
                                <div class="col-md-6">
                                    <input placeholder="Password Confirmation" id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                            </div>
                            <!-- form-group// -->

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>

                            <!-- form-group// -->
                            <div class="d-flex justify-content-center" style="font-size:9pt;">
                                have account?&nbsp;&nbsp;<a href="{{ route('login') }}">
                                    {{ __('Login Now!') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <footer class="text-center">
                <p class="font-sm mb-0">&copy; {{ date('Y') }} <a href='https://innovated.co.id' target="_blank"><strong class="text-brand">InnovateD Indonesia</strong></a> - Sistem Informasi Katalog ZIVAR <br />All rights reserved</p>
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

            // @if($errors->any())
            //     var times = {{ $int = (int) filter_var($errors->first(), FILTER_SANITIZE_NUMBER_INT); }};
            //     var timeOut = times*1000;
            //     let timerInterval;

            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Too many login attempts!',
            //         html: 'Please try again in <b></b> seconds.',
            //         timer: timeOut,
            //         timerProgressBar: true,
            //         allowOutsideClick: false,
            //         showClass: {
            //             popup: 'animate__animated animate__fadeInDown'
            //         },
            //         hideClass: {
            //             popup: 'animate__animated animate__fadeOutUp'
            //         },
            //         didOpen: () => {
            //             Swal.showLoading()
            //             const b = Swal.getHtmlContainer().querySelector('b')
            //             timerInterval = setInterval(() => {
            //                 b.textContent = Math.round(Swal.getTimerLeft()/1000)
            //             }, 1000)
            //         },
            //         willClose: () => {
            //             clearInterval(timerInterval)
            //         }
            //     }).then((result) => {
            //     /* Read more about handling dismissals below */
            //         if (result.dismiss === Swal.DismissReason.timer) {
            //             console.log('I was closed by the timer')
            //         }
            //     })
            // @endif

            $(function () {

            });
        </script>

        <script src="{{asset('vendor/select2/dist/js/select2.min.js') }}"></script>
        <script text="text/javascript">
            $(document).ready(function() {
                $('.select2Form').select2({
                    placeholder: "Pilih Cabang",
                    allowClear: true,
                });
            });
        </script>
    </body>
</html>
