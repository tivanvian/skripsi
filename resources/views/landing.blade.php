<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />

    <title>{{ config('app.name') }} | @yield('title', $page['title'] ?? '')</title>

    @include('layouts.frontend.styles')
</head>

<body>

    @include('layouts.frontend.header')

    <!--End header-->

    @yield('content')

    @include('layouts.frontend.footer')

    {{-- Preloader  --}}

    @include('layouts.frontend.preloader')

    {{-- JS  --}}

    @include('layouts.frontend.javascripts')

</body>

</html>
