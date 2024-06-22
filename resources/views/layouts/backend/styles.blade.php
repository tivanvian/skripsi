<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/imgs/theme/favicon_152x152.png') }}" />
<!-- Template CSS -->
<link href="{{asset('backend/assets/css/main.css?v=1.1') }}" rel="stylesheet" type="text/css" />


{{-- Vendor --}}
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('vendor/izitoast/dist/css/iziToast.min.css') }}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css') }}">

<link href="{{asset('vendor/fontawesome/css/all.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>


<style>
    /*page loading*/
    .preloader {
        background-color: #fff;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 999999;
        -webkit-transition: .6s;
        transition: .6s;
        margin: 0 auto;
    }

    .preloader img.jump {
     max-height: 100px;
    }`
</style>



@stack('styles')
