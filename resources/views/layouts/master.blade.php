<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{asset('assets/css/alert.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="{{asset("assets/fontawesome/css/fontawesome.css")}}" rel="stylesheet" />
        <link href="{{asset("assets/fontawesome/css/brands.css")}}" rel="stylesheet" />
        <link href="{{asset("assets/fontawesome/css/solid.css")}}" rel="stylesheet" />
        @php
            $header = getHeader();
        @endphp
        @if (isset($header['logo']))
            <link rel="shortcut icon" href="{{ $header['favicon'] }}" type="image/x-icon">
        @else
            <link rel="shortcut icon" href="{{ asset('assets/user/img/box.png') }}" type="image/x-icon">
        @endif
        @stack('head')
    </head>
    <body>
        <div id="alert">
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    setTimeout(() => {
                        document.querySelector("#alert").innerHTML += `@include('common.error')`;
                    }, 500);
                })
            </script>
        </div>
        @yield('content')
    </body>
    <footer>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @stack('footer')
    </footer>
</html>

