<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{asset('assets/css/alert.css')}}">
        <script src="https://kit.fontawesome.com/1c7dcab6ce.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        @stack('head')
        
    </head>
    <body>
        <div id="alert">
            @include('common.error')
        </div>
        @yield('content')
    </body>
    <footer>
        @stack('footer')
    </footer>
</html>

