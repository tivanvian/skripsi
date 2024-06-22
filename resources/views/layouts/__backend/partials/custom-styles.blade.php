
@stack('styles')
<style>
    .hover-up {
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
    }

    .hover-up:hover {
        -webkit-transform: translateY(-2px);
        transform: translateY(-2px);
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
    }

    .select2mt20{
        margin-top: -20px;
    }

    .box {
        margin-top:-15px; !important;
        margin-bottom:-15px; !important;
    }

    span.select2 {
        padding-bottom: 0;
        margin-bottom: 0;
        height: 30px;
    }

    span.select2-selection.select2-selection--single {
        height: 35px !important;
        border: var(--bs-border-width) solid var(--bs-border-color) !important;
    }

    span.select2-selection__rendered {
        margin-top: -6px;
        /* margin-left: -10px; */
        padding: 0 !important;
    }

    span.select2-selection__placeholder {
        color: #5e6464 !important;
    }

    span.select2-dropdown {
        border: 1px solid #dee2e6 !important;
    }

    button.select2-selection__clear {
        margin-top: -5px;
    }

</style>

<link rel="stylesheet" href="{{asset('vendor/izitoast/dist/css/iziToast.min.css') }}">
<link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
