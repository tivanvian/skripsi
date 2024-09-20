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

        <link
              rel="stylesheet"
              href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.css"
              />
        <link
              rel="stylesheet"
              href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.autoplay.css"
              />
        <style>
          #myCarousel {
            --f-carousel-spacing: 10px;
            --f-carousel-slide-width: 100%;
            --f-progress-color: #ff3520;
          }

          #myCarousel .f-carousel__slide {
            padding-top: 20px;
            padding-bottom: 20px;
            /* margin-bottom:20px; */
            background: #eee;
          }

          #myCarousel .f-carousel__dots {
            /* margin-top: -0px !important; */
            display: none;
          }
        </style>

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

        <style>
        /* Basic styling for demonstration */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            /* margin-top: 20px; */
            /* background-color: #f9f9f9; */
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            padding: 8px 0;
            right: 0;
            text-align: center;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown .dropbtn {
            /* background-color: #red; */
            /* color: white; */
            padding: 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        .dropdown .dropbtn i {
            margin-right: 5px;
        }
        </style>

        <style>
          .blurred-background {
              filter: blur(5px);
              transition: filter 0.3s;
          }

          /* Prevent blurring the modal content */
          .modal-backdrop {
              background-color: rgba(0, 0, 0, 0.5);
          }

          .modal-wrapper {
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              display: flex;
              justify-content: center;
              align-items: center;
              z-index: 1050;
          }
        </style>

        <style>
          /* Carousel Container */
          .carousel-container {
              position: relative;
              width: 100%;
              height: 500px;
              overflow: hidden;
              border-radius: 10px;
              background-color: #f8f9fa; /* Light gray background */
              display: flex;
              align-items: center;
              justify-content: center;
          }

          /* Carousel Slides Wrapper */
          .carousel-wrapper {
              display: flex;
              width: 100%;
              height: 100%;
              transition: transform 0.5s ease-in-out;
          }

          /* Each Carousel Item */
          .carousel-item {
              min-width: 100%;
              height: 100%;
              flex-shrink: 0;
          }

          /* Images and Videos in Carousel */
          .carousel-item img, .carousel-item video {
              width: 100%;
              height: 100%;
              object-fit: cover;
          }

          /* Carousel Control Buttons */
          .carousel-controls {
              position: absolute;
              top: 50%;
              width: 100%;
              display: flex;
              justify-content: space-between;
              transform: translateY(-50%);
              pointer-events: none; /* Prevent blocking clicks */
          }

          .carousel-btn {
              background-color: rgba(0, 0, 0, 0.5);
              border: none;
              color: white;
              padding: 10px;
              cursor: pointer;
              pointer-events: all; /* Allow clicking */
              transition: background-color 0.3s;
          }

          .carousel-btn:hover {
              background-color: rgba(0, 0, 0, 0.8);
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

            <div class="dropdown">
              <button class="dropbtn" onclick="toggleDropdown()">
                  <i class="fa fa-bars"></i>
              </button>
              <div class="dropdown-content" id="dropdownMenu">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
                  </form>
              </div>
          </div>

            {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="btn btn-danger py-2 d-flex align-items-center" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
            </form> --}}
          </header>
      
          <div class="f-carousel" id="myCarousel">
            @foreach($sliders as $slider)
              @if(in_array($slider->extension, ['jpg', 'jpeg', 'png', 'gif']))
                <div class="f-carousel__slide">
                  <img src="{{ url($slider->url) }}" alt="Image 2" style="max-height:500px;">
                </div>
              @endif
            @endforeach
          </div>
      
          <div class="row align-items-md-stretch">
            
            @php
              $count = count($pelayananLoket);
              if($count == 0) {
                $classColMd = 'col-md-12';
              } elseif($count == 1) {
                $classColMd = 'col-md-12';
              } elseif($count == 2) {
                $classColMd = 'col-md-6';
              } elseif($count == 3) {
                $classColMd = 'col-md-4';
              } elseif($count == 4) {
                $classColMd = 'col-md-3';
              } elseif($count == 5) {
                $classColMd = 'col-md-2';
              } else {
                $classColMd = 'col-md-12';
              }
            @endphp
            @foreach($pelayananLoket as $pelayanan)
              {{-- {{dd($pelayanan)}} --}}
              <div class="{{$classColMd}}">
                <a href="#" class="text-decoration-none clickAntrian" data-antrian="{{$pelayanan["nama"]}}" data-alias="{{$pelayanan["alias"]}}" data-action="{{route('antrian.get-antrian')}}" data-wilayah="{{\Auth::user()->wilayah}}">
                  <div class="bg-body-tertiary border rounded-3 d-flex align-items-center justify-content-center" style="height: 300px">
                    <h2>
                      LOKET {{ strtoupper($pelayanan["nama"]) }}
                    </h2>
                  </div>
                </a>
              </div>
            @endforeach
            
            
          </div>
    
        </div>
      </main>

      <div class="modal-wrapper" id="modalWrapper" style="display: none; z-index:10000;">
        <!-- Modal -->
        <div style="z-index:10000;" class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-body"> 
                <div class="modal-toggle-wrapper">  
                  {{-- <ul class="modal-img">
                    <li> <img src="../assets/images/gif/danger.gif" alt="error"></li>
                  </ul> --}}
                  <h4 class="text-center" id="headerModal" style="font-size: 45pt;"></h4>
                  <p class="text-center">
                    <span class="text-center" style="font-size: 30pt;">
                      Nomor Antrian Anda adalah
                    </span>
                    <div id="bodyModal" class="text-center" style="font-size: 50pt;"></div>
                    <br>
                    <div id="qrcode" style="text-align: center !important;" class="d-flex align-items-center justify-content-center"></div>
                    <br>
                    <div class="d-flex flex-row align-items-center justify-content-center">
                      <i class="text-center" style="font-size: 20pt;">
                        Scan QR Code untuk melihat status antrian pada Handphone/Smartphone anda
                        <br>
                        Jendela akan otomatis tertutup dalam 10 detik
                      </i>
                    </div>
                  </p>
                  <button class="btn btn-danger btn-lg d-flex m-auto" type="button" id="btnModalAntrian">Tutup</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Jquery --}}
      <script src="{{ asset('themes/assets/js/jquery.min.js') }}"></script>
      {{-- ../assets/js/bootstrap/popper.min.js --}}
      {{-- <script src="{{asset('themes/assets/js/bootstrap/popper.min.js')}}"></script> --}}
      {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> --}}
      <script src="{{asset('example/assets/dist/js/bootstrap.bundle.min.js')}}"></script>
      {{-- //resource echo js --}}
      {{-- <script src="{{ asset('js/app.js') }}"></script>
      <script src="{{ asset('js/echo.js') }}"></script> --}}

      {{-- <script>
        window.Echo.channel("delivery").listen("PackageSent", (event) => {
            console.log(event);
        });
      </script> --}}
      <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.umd.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.autoplay.umd.js"></script>
      <script>
        new Carousel(document.getElementById("myCarousel"), {
          Autoplay : {
            timeout : 10000
          }
        }, {
          Autoplay
        });
      </script>

      

      <script>
        function toggleDropdown() {
            var dropdownMenu = document.getElementById("dropdownMenu");
            dropdownMenu.classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>

      

      {{-- <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script> --}}

      <script src="{{asset('vendor/qrcodejs/qrcode.min.js')}}"></script>

      <script type="text/javascript">
        $(function () {

          // $('#exampleModalCenter1').modal({
          //   backdrop: 'static',
          //   keyboard: false
          // });

          let qrcodeDiv;
          let timeoutId;

          // If click .clickAntrian
          $('.clickAntrian').click(function (e) {
            e.preventDefault();
      
            loadingSpinner.style.display = 'flex';
      
            var antrian = $(this).data('antrian');
            var alias = $(this).data('alias');
            var wilayah = $(this).data('wilayah');
            var url = $(this).data('action');
      
            // Clean headerModal and bodyModal
            $('#headerModal').text('');
            $('#bodyModal').html(''); // Use .html() to be able to insert HTML content
      
            // Ajax
            $.ajax({
              type: "POST",
              url: url,
              data: {
                "_token": "{{ csrf_token() }}",
                "tipe_loket": antrian,
                "alias" : alias,
                "kode_wilayah": wilayah,
              },
              success: async function (data) {
                console.log(data);
                if (data.success == true) {
                  
      
                  await $('#headerModal').text('ANTRIAN LOKET ' + data.data.tipe_loket.toUpperCase());

                  qrcodeDiv = new QRCode(document.getElementById("qrcode"), {
                    text: data.link,
                    width: 250,
                    height: 250,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                  });

                  // Set data to bodyModal
                  await $('#bodyModal').html('<strong style="font-size: 50pt;">' + data.data.alias + '-' + data.data.number + '</strong>');
      
                  // Open Modal
                  await $('#exampleModalCenter1').modal({
                      backdrop: 'static', // Disable closing by clicking outside
                      keyboard: false // Disable closing with the keyboard
                  });

                  await $('#exampleModalCenter1').modal('show');
                  
                  loadingSpinner.style.display = 'none';
                } else {
                  alert('Error');
                }
              }
            });

            // Close Modal after 10 seconds
            timeoutId = setTimeout(function() {
              $('#exampleModalCenter1').modal('hide');
              qrcodeDiv.clear();
              $('#qrcode').html('');
            }, 10000);

          });

          // // Close Modal after 10 seconds
          // setTimeout(function() {
          //   $('#exampleModalCenter1').modal('hide');
          //   qrcodeDiv.clear();
          //   //qrcode div clear
          //   $('#qrcode').html('');
          // }, 10000);

          $('#btnModalAntrian').click(function() {
            $('#exampleModalCenter1').modal('hide');
            qrcodeDiv.clear();
            //qrcode div clear
            $('#qrcode').html('');

            if (timeoutId) {
              clearTimeout(timeoutId);
            }
          });


          // Add blur effect when modal is shown
          $('#exampleModalCenter1').on('shown.bs.modal', async function () {
              // $('body').addClass('blurred');
              await $('#modalWrapper').show();
              await $('body > *:not(#modalWrapper)').addClass('blurred-background');
          });

          // Remove blur effect when modal is hidden
          $('#exampleModalCenter1').on('hidden.bs.modal', async function () {
              // $('body').removeClass('blurred');
              await $('#modalWrapper').hide();
              await $('body > *:not(#modalWrapper)').removeClass('blurred-background');

              // Cancel the timeout if the modal is closed
              if (timeoutId) {
                  clearTimeout(timeoutId);
              }
          });

          //setInterval to getAntrian every 1 seconds
          // setInterval(getAntrian, 1000);
          

        });
      </script>

      {{-- <script src="https://code.responsivevoice.org/responsivevoice.js?key=CO1qFP9H"></script> --}}

      <script type="text/javascript">
        const loadingSpinner = document.getElementById('loading-spinner');

        document.addEventListener('DOMContentLoaded', function() {
          loadingSpinner.style.display = 'none';
        });


        

        $(function () {


          // let voices = [];

          // function populateVoiceList() {
          //     voices = window.speechSynthesis.getVoices();
          // }

          // function speak(text) {
          //     // const speechSynthesisUtterance = new SpeechSynthesisUtterance(text);

          //     // // Set the speech rate
          //     // speechSynthesisUtterance.rate = "0.8";

          //     // // Set Indonesian voice
          //     // speechSynthesisUtterance.voice = voices.find(voice => voice.lang === 'id-ID');

          //     // // Speak the text
          //     // window.speechSynthesis.speak(speechSynthesisUtterance);

          //     // Create a SpeechSynthesisUtterance
          //     const utterance = new SpeechSynthesisUtterance(text);

          //     // Select a voice
          //     const voices = speechSynthesis.getVoices();
          //     utterance.voice = voices[0]; // Choose a specific voice

          //     // Speak the text
          //     speechSynthesis.speak(utterance);
          // }

          
          
          //function to ajax get antrian.get-call
          function getAntrian() {
            let wilayah = "{{\Auth::user()->wilayah}}";
            var nomorAntrian = document.getElementById('nomorAntrian');
            var loket = document.getElementById('loket');

            $.ajax({
              type: "GET",
              url: "{{ url('/antrian/get-call/') }}/" + wilayah,
              success: async function (data) {
                console.log(data);
                if(data["success"] == true) {
                  nomorAntrian.innerHTML  = '';
                  loket.innerHTML  = '';
                  nomorAntrian.innerHTML = data['data']['number'];
                  loket.innerHTML  = "LOKET " + (data['data']['loket']).toUpperCase();

                  // await stopAntrian();
                  // console.log(data);

                }
              }
            });
          }

          // function stopAntrian() {
          //   let wilayah = "{{\Auth::user()->wilayah}}";

          //   $.ajax({
          //     type: "GET",
          //     url: "{{ url('/antrian/post-call/') }}/" + wilayah + "/client",
          //     success: async function (data) {
          //       if(data["success"] == true) {
          //         console.log(data);
          //       }
          //     }
          //   });
          // }

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

          // setInterval(updateDateTime, 1000);
          updateDateTime(); // initial call to display date and time immediately

          //setInterval updateDetTime and getAntrian
          setInterval(() => {
            updateDateTime();
          }, 1000);

          // setInterval(() => {
          //   getAntrian();
          // }, 500);
          // getAntrian();

          // populateVoiceList();
          // if (typeof speechSynthesis !== 'undefined' && speechSynthesis.onvoiceschanged !== undefined) {
          //     speechSynthesis.onvoiceschanged = populateVoiceList;
          // }

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