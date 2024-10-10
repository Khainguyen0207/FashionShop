<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            display: flex;
            width: 100%;
            background-color: #f3f3f5;
            font-family: Arial, sans-serif;
        }
        .container {
            display: inline-block;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px auto;
            width: 600px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
        }
        h3 {
            text-align: center;
            margin: 0;
            padding: 10px 0;
        }
        .code {
            background-color: lightgray;
            letter-spacing: 10px;
            padding: 15px;
            margin: 20px 0;
            font-size: 24px;
            text-align: center;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        p {
            margin: 10px 0;
            color: #555;
        }
        footer {
            text-align: center;
            color: gray;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Fashion Shop</h3>
        <h1>Chào {{ $name }}!</h1>
        <p>Chúng tôi rất vui khi bạn tham gia cùng chúng tôi. Để bảo mật tài khoản của bạn, chúng tôi cần xác thực danh tính của bạn.</p>
        <h2><strong>Mã Xác Thực</strong></h2>
        <div class="code">{{ $code }}</div>
        <p>Mã xác thực này chỉ có hiệu lực trong vòng 10 phút. Nếu bạn không yêu cầu mã xác thực này hoặc gặp vấn đề, vui lòng liên hệ với chúng tôi qua <a href="mailto:{{ $mail_contact }}">{{ $mail_contact }}</a>.</p>
        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi. Chúc bạn có một ngày tuyệt vời!</p>
        <p>Trân trọng,<br><a href="mailto:{{ $mail_contact }}">{{ $mail_contact }}</a></p>
        <footer>
            <p>Copyright © 2024 <a href="https://www.noob.test">www.noob.test</a></p>
        </footer>
    </div>
</body>
</html>
