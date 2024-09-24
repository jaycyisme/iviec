<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="Trang quản lý của {{ config('app.name', 'Hoang Anh Gaming') }}" />
        <title>{{ config('app.name', 'Hoang Anh Gaming') }}</title>

        <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}" >
        <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" >
        <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" >
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link" >
        <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" >
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body data-pc-preset="preset-1" data-pc-sidebar-theme="dark" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="dark">
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>

        <div class="auth-main v1">
            <div class="auth-wrapper">
                <div class="auth-form">
                    <div class="card my-5">
                        <div class="card-body">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
                <div class="auth-sidefooter">
                    <img src="https://hoanganhgaming.com/logo.png" class="img-brand img-fluid" alt="images" style="width:128px;" />
                    <hr class="mb-3 mt-4" />
                    <div class="row">
                        <div class="col my-1">
                            <p class="m-0">Thiết kế bởi <a href="https://hoanganhgaming.com/" target="_blank">Hoang Anh Gaming Software</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
        <script src="{{ asset('assets/js/pcoded.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

        @livewireScripts
    </body>
</html>
