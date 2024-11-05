<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404  </title>
    <style>
        * {
            margin: 0;
            padding: 0;
            
        }

        body {
            width: 100%;
            height: 100vh;
            text-align: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', Helvetica, 'ヒラギノ角ゴ Pro W3', 'メイリオ', Meiryo, 'ＭＳ Ｐゴシック', Arial, sans-serif;
        }
    </style>
</head>
<body>
    {{-- <div class="img-404">
        <h1 class="notifition">Anh yêu em thì có chứ trang thì không tìm thấy</h1>
    </div> --}}
    <div class="error">
        <img src="{{ asset("assets/img/404.gif") }}" style="max-width: 100%" alt="404">
        <h2 style="color: orange">Oops! Something went wrong</h2>
        <p> We couldn't find the page you were looking for. <br>Why not try back to the <span><a style="color: orange" href="/">homepage</a></span>.</p>
    </div>
</body>
</html>