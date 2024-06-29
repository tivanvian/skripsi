<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('meta')

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
