<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

        <title>{{ config('app.name') }} | @yield('content-title', $page['content-title'] ?? '')</title>

        @include('layouts.backend.styles')

    </head>

    <body class="{{ ToogleAsideMini() }}">

        {{-- @include('layouts.frontend.preloader') --}}

        @include('layouts.backend.menu')

        <main class="main-wrap">

            @include('layouts.backend.header')

            <section class="content-main">

                @yield('content-header')

                @yield('content-body')

            </section>

            @include('layouts.backend.footer')

        </main>

        @yield('modal')


        @include('layouts.backend.javascripts')

    </body>
</html>
