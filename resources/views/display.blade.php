<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('meta')

        <title>{{ config('app.name') }}</title>

        @include('layouts.__backend.partials.icon')

        <script src="{{asset('example/assets/js/color-modes.js')}}"></script>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/jumbotron/">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

        <link href="{{asset('example/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">

        <link href="{{asset('vendor/fontawesome/css/all.css') }}" rel="stylesheet">

        <style>
          .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
          }
    
          @media (min-width: 768px) {
            .bd-placeholder-img-lg {
              font-size: 3.5rem;
            }
          }
    
          .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
          }
    
          .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
          }
    
          .bi {
            vertical-align: -.125em;
            fill: currentColor;
          }
    
          .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
          }
    
          .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
          }
    
          .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
    
            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
          }
    
          .bd-mode-toggle {
            z-index: 1500;
          }
    
          .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
          }
        </style>

      <style>
        /* Full-page overlay */
        #loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Make sure it covers other content */
            cursor: not-allowed;
        }

        /* Spinner animation */
        .spinner {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        /* Spinner keyframes */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
      </style>
    </head>

    <body>
      <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
          <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
          <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
          <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
          <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
        </symbol>
      </svg>
  
      <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
              <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
              Light
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
              <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
              Dark
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
              <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
              Auto
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
        </ul>
      </div>

      <div id="loading-spinner">
          <div class="spinner"></div>
      </div>

      <main>
        <div class="px-5 py-5 text-center">

          <header class="pb-3 mb-4 border-bottom d-flex justify-content-between">
            <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
              <img src="{{asset('example/assets/brand/bootstrap-logo.svg')}}" alt="" height="32" class="me-2">
              <span class="fs-4 d-flex">
                {{ strtoupper($wilayah->name) }} &nbsp;&nbsp;|&nbsp;&nbsp; <span id="live-date"></span>&nbsp;<span id="live-clock"></span>
              </span>
            </a>

            
          </header>
          
          <div class="row">

            <div class="col-md-4">
                @foreach($pelayananLoket as $pelayanan)
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="bg-body-tertiary border rounded-3 d-flex align-items-center justify-content-center" style="height: 220px;">
                            <div>
                              <p class="text-black" style="font-size:15pt;">
                                Antrian Sekarang
                              </p>
                              <h1 class="fw-bold" style="font-size:40pt;">
                                <span id="nomorAntrian_{{$pelayanan}}" class="text-danger">
                                  0
                                </span>
                              </h1>
                              <p class="text-black" style="font-size:15pt;">
                                <span id="loket_{{$pelayanan}}">
                                  LOKET {{ strtoupper($pelayanan) }}
                                </span>
                            </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="col-md-8" style="display: none;" id="showAntrian">
                <div class="mb-3 bg-body-tertiary rounded-3 d-flex align-items-center justify-content-center" style="height: 730px;">
                    <div class="container-fluid">
                      <p class="" style="font-size:30pt;">
                        Antrian Sekarang
                      </p>
                      <h1 class="fw-bold" style="font-size:100pt;">
                        <div id="nomorAntrian" class="text-danger">
                          NOMOR ANTRIAN
                        </div>
                      </h1>
                      <p class="" style="font-size:30pt;">
                        <div id="loket" style="font-size:30pt !important;"></div>
                      </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8" id="showVideo">
              <div class="mb-3 bg-body-tertiary rounded-3 d-flex align-items-center justify-content-center" style="height: 730px;">
                  <div class="container-fluid">
                    INI BUAT SLIDE SHOW VIDEO
                  </div>
              </div>
          </div>



          </div>
          
      
          {{-- <div class="row align-items-md-stretch">

          </div> --}}
    
        </div>
      </main>

      {{-- Jquery --}}
      <script src="{{ asset('themes/assets/js/jquery.min.js') }}"></script>
      <script src="{{asset('example/assets/dist/js/bootstrap.bundle.min.js')}}"></script>

      <script>
          const loadingSpinner = document.getElementById('loading-spinner');

          document.addEventListener('DOMContentLoaded', function() {
              loadingSpinner.style.display = 'none';
          });

          function updateDateTime() {
              const dateElement = document.getElementById('live-date');
              const clockElement = document.getElementById('live-clock');
              const now = new Date();

              const day = now.getDate();
              const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
              const month = monthNames[now.getMonth()];
              const year = now.getFullYear();

              const hours = String(now.getHours()).padStart(2, '0');
              const minutes = String(now.getMinutes()).padStart(2, '0');
              const seconds = String(now.getSeconds()).padStart(2, '0');

              dateElement.textContent = `${day} ${month} ${year}`;
              clockElement.textContent = `${hours}:${minutes}:${seconds}`;
          }

        setInterval(updateDateTime, 1000);
        updateDateTime(); // initial call to display date and time immediately
      </script>

      <script src="https://code.responsivevoice.org/responsivevoice.js?key=CO1qFP9H"></script>

      <script type="text/javascript">

        $(function () {
          
          //function to ajax get antrian.get-call
          function getAntrian() {
            let wilayah = "{{\Auth::user()->wilayah}}";
            var nomorAntrian = document.getElementById('nomorAntrian');
            var loket = document.getElementById('loket');

            $.ajax({
              type: "GET",
              url: "{{ url('/antrian/get-call/') }}/" + wilayah,
              success: async function (data) {
                if(data["success"] == true) {

                  //showVideo hide showAntrian show
                  // document.getElementById('showVideo').style.display = 'none';
                  // document.getElementById('showAntrian').style.display = 'block';

                  nomorAntrian.innerHTML  = '';
                  loket.innerHTML  = '';

                  nomorAntrian.innerHTML = data['data']['number'];
                  loket.innerHTML  = "LOKET " + (data['data']['loket']).toUpperCase();

                  await responsiveVoice.speak(data['data']['sound_call'], "Indonesian Female", {rate: 0.86});

                  document.getElementById('showVideo').style.display = 'none';
                  document.getElementById('showAntrian').style.display = 'block';

                  // if(responsiveVoice.isPlaying()) {
                  //   //showVideo hide showAntrian show
                  //   document.getElementById('showVideo').style.display = 'none';
                  //   document.getElementById('showAntrian').style.display = 'block';
                  // } else {
                  //   //showVideo hide showAntrian show
                  //   document.getElementById('showAntrian').style.display = 'none';
                  //   document.getElementById('showVideo').style.display = 'block';
                  // }

                  await stopAntrian();
                  console.log(data);
                }
              }
            });
          }


          function getAntrianNow() {
            let wilayahNow = "{{\Auth::user()->wilayah}}";
            // var nomorAntrian = document.getElementById('nomorAntrian');
            // var loket = document.getElementById('loket');

            $.ajax({
              type: "GET",
              url: "{{ url('/antrian/get-now/') }}/" + wilayahNow,
              success: async function (data) {
                if(data["success"] == true) {
                  //data["data"] foreach
                  $.each(data["data"], function(key, value) {

                    console.log(key + " : " + value.loket + " : " + value.number);
                    // nomorAntrian_{{$pelayanan}} = document.getElementById('nomorAntrian_'+key);
                    // loket_{{$pelayanan}} = document.getElementById('loket_'+key);

                    document.getElementById('nomorAntrian_'+value.loket).innerHTML  = '';
                    document.getElementById('loket_'+value.loket).innerHTML  = '';

                    document.getElementById('nomorAntrian_'+value.loket).innerHTML = value.number;
                    document.getElementById('loket_'+value.loket).innerHTML  = "LOKET " + (value.loket).toUpperCase();
                    // var nomorAntrian = document.getElementById('nomorAntrian_'+key);
                    // var loket = document.getElementById('loket_'+key);

                    // nomorAntrian.innerHTML  = '';
                    // loket.innerHTML  = '';

                    // nomorAntrian.innerHTML = value['number'];
                    // loket.innerHTML  = "LOKET " + (value['loket']).toUpperCase();
                  });



                  // nomorAntrian.innerHTML  = '';
                  // loket.innerHTML  = '';

                  // nomorAntrian.innerHTML = data['data']['number'];
                  // loket.innerHTML  = "LOKET " + (data['data']['loket']).toUpperCase();

                  // await responsiveVoice.speak(data['data']['sound_call'], "Indonesian Female", {rate: 0.86});

                  // await stopAntrian();
                  // console.log(data);
                }
              }
            });
          }

          function stopAntrian() {
            let wilayah = "{{\Auth::user()->wilayah}}";

            $.ajax({
              type: "GET",
              url: "{{ url('/antrian/post-call/') }}/" + wilayah + "/client",
              success: async function (data) {
                if(data["success"] == true) {
                  console.log(data);
                }
              }
            });

            //settimout
            setTimeout(() => {
              //showVideo hide showAntrian show
              document.getElementById('showAntrian').style.display = 'none';
              document.getElementById('showVideo').style.display = 'block';
            }, 15000);
          }

          

          setInterval(() => {
            getAntrian();
            getAntrianNow();
          }, 500);

        });
        

      </script>




    </body>
</html>


{{-- // $.ajax({
  //   type: "POST",
  //   url: "{{ route('antrian.store') }}",
  //   data: {
  //     "_token": "{{ csrf_token() }}",
  //     "loket": antrian
  //   },
  //   success: function (data) {
  //     if(data.status == 'success') {
  //       $('#nomorAntrian').text(data.nomor_antrian);
  //       $('#loket').text('Loket ' + data.loket);
  //     } else {
  //       alert(data.message);
  //     }
  //   }
  // }); --}}