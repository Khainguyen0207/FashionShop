<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
</head>
<body style="display: flex; width: 100%; background-color: white;">
    <div style="display: inline-block; background-color: #f3f3f5; padding: 15px 40px; margin: 0 auto;">
        <table style="display: block; border-radius: 5px;background-color: white; padding: 10px; width: 600px;align-items: center;">
            <tr style="display: block;border-bottom: 1px solid gray;">
                <td style="height: 30px;">
                    <table style="position: relative; display: block;">
                        <tr style="position: relative;display: flex; justify-content: space-between;">
                            <td>
                                <img style="display:block; width: 20%;" src="{{ $message->embed(asset('assets/img/logo-2.png')) }}" alt="logo">
                            </td>
                            <td >
                                <h1 style="text-align: center;">Fashion Shop</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="position: relative;display: block;border-bottom: 1px solid lightgray;;">
                <td>
                    <h1 style="color: #333;">Chào {{$name}}!</h1>
                    <p>Chúng tôi rất vui khi bạn tham gia cùng chúng tôi. 
                        Để bảo mật tài khoản của bạn, chúng tôi cần xác thực danh tính của bạn. </p>
                    <h2><strong>Mã Xác Thực </strong></h2>
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <h1 style="background-color: lightgray; letter-spacing: 10px; padding: 10px; margin: 0 auto;">{{$code}}</h1>
                    </div>
                    <p>Mã xác thực này chỉ có hiệu lực trong vòng 10 phút. Nếu bạn không yêu cầu mã xác thực này hoặc gặp vấn đề, vui lòng liên hệ với chúng tôi qua <a href="mailto:{{$mail_contact}}" style="color: #007bff;">{{$mail_contact}}</a>.</p>
                    <p style="margin-top: 20px;">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi. Chúc bạn có một ngày tuyệt vời!</p>
                    <p >Trân trọng <br><a href="mailto:{{$mail_contact}}" style="color: #007bff;">{{$mail_contact}}</a></p>
                </td>
            </tr>
            <tr >
                <td>
                    <p style="color: gray;text-align: center;">Copyright © 2024 <a href="noob.test">www.noob.test</a></p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
