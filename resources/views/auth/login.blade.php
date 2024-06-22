<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Zivar Core V1">
    <meta name="keywords" content="zivar, core, zivar core, zivar-core, zivar_core">
    <meta name="author" content="Zivar">

    <title>{{ config('app.name') }} | Login</title>

    <link rel="icon" href="{{ asset('themes/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('themes/assets/images/favicon.png') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('themes/assets/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/assets/css/vendors/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/assets/css/vendors/flag-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/assets/css/responsive.css') }}">

    <link rel="stylesheet" href="{{asset('vendor/izitoast/dist/css/iziToast.min.css') }}">

    <link id="color" rel="stylesheet" href="{{ asset('themes/assets/css/color-1.css') }}" media="screen">

    <!-- Include script -->
    <script type="text/javascript">
        function callbackThen(response) {

            // read Promise object
            response.json().then(function(data) {

            if(data.success && data.score >= 0.6) {

            } else {
                document.getElementById('FormData').addEventListener('submit', function(event) {
                    event.preventDefault();
                });

                showToast('red', 'Error', "Recaptcha invalid, Please try to Reload Your Browser!.");
                $('#submitForm').attr('disabled', true);
            }
            });
        }

        function callbackCatch(error){
            console.error('Error:', error)
        }
    </script>

    {!! htmlScriptTagJsApi([
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch',
    ]) !!}

  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{ asset('themes/assets/images/login/2.jpg') }}" alt="looginpage"></div>
        <div class="col-xl-5 p-0">
          <div class="login-card login-dark">
            <div>
              <div><a class="logo text-start" href="{{url('/')}}"><img class="img-fluid for-light" src="{{ asset('themes/assets/images/logo/logo.png') }}" alt="looginpage"><img class="img-fluid for-dark" src="{{ asset('themes/assets/images/logo/logo_dark.png') }}" alt="looginpage"></a></div>
              <div class="login-main">
                <form class="theme-form" id="FormData" method="POST" action="{{ route('login') }}">
                  @csrf
                  <h4>Sign in to account</h4>
                  <p>Enter your email & password to login</p>

                  {{-- <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    <div class="col-md-6">
                        {!! RecaptchaV3::field('register') !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>
                  </div> --}}

                  <div class="form-group">
                    <label class="col-form-label">Email Address</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Test@gmail.com" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  </div>

                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="*********" id="password" name="password" required autocomplete="current-password" >
                      <div class="show-hide"><span class="show">                         </span></div>
                    </div>
                  </div>

                  <div class="form-group mb-0">
                    @if (Route::has('password.request'))
                    <div class="mb-3 d-flex justify-content-end">
                        <a style="font-size:9pt;" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                    @endif
                    <button class="btn btn-primary btn-block w-100" id="submitForm" type="submit">Sign in</button>
                  </div>
                  <h6 class="text-muted mt-4 or">Or Sign in with</h6>
                  <div class="social mt-4">
                    <div class="btn-showcase"><a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank"><i class="txt-linkedin" data-feather="linkedin"></i> LinkedIn </a><a class="btn btn-light" href="https://twitter.com/login?lang=en" target="_blank"><i class="txt-twitter" data-feather="twitter"></i>twitter</a><a class="btn btn-light" href="https://www.facebook.com/" target="_blank"><i class="txt-fb" data-feather="facebook"></i>facebook</a></div>
                  </div>
                  @if (Route::has('register'))
                  <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="{{ route('register') }}">Create Account</a></p>
                  @endif
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- latest jquery-->
      <script src="{{ asset('themes/assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('themes/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('themes/assets/js/icons/feather-icon/feather.min.js') }}"></script>
      <script src="{{ asset('themes/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
      <script src="{{ asset('themes/assets/js/config.js') }}"></script>
      {{-- <script src="{{ asset('themes/assets/js/script.js') }}"></script> --}}
      <!-- Plugin used-->

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

        @if($errors->any())
            var times = {{ $int = (int) filter_var($errors->first(), FILTER_SANITIZE_NUMBER_INT); }};
            var timeOut = times*1000;
            let timerInterval;

            Swal.fire({
                icon: 'error',
                title: 'Too many login attempts!',
                html: 'Please try again in <b></b> seconds.',
                timer: timeOut,
                timerProgressBar: true,
                allowOutsideClick: false,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Math.round(Swal.getTimerLeft()/1000)
                    }, 1000)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
            /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                }
            })
        @endif

        $(function () {
          /*----------------------------------------
          passward show hide
          ----------------------------------------*/
          $('.show-hide').show();
          $('.show-hide span').addClass('show');

          $('.show-hide span').click(function () {
              if ($(this).hasClass('show')) {
                  $('#password').attr('type', 'text');
                  $(this).removeClass('show');
              } else {
                  $('#password').attr('type', 'password');
                  $(this).addClass('show');
              }
          });
          $('form button[type="submit"]').on('click', function () {
              $('.show-hide span').addClass('show');
              $('.show-hide').parent().find('#password').attr('type', 'password');
          });

        });




      </script>
    </div>
  </body>
</html>
