<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script src="https://kit.fontawesome.com/1c7dcab6ce.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
        @stack('head')
    </head>
    <body>
        @include('common.error')
        @yield('content')
    </body>
    <footer>
        @stack('footer')
    <script src="{{ asset('assets/js/table.js') }}"></script>

    </footer>
</html>