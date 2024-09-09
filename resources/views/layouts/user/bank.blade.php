@push('head')
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/banking.css')}}">
<title>Trang chủ</title>
<div id="banking">
    <div class="header">
        <h1 style="color: brown; padding: 0px 20px">Thanh toán trực tuyến</h1>
    </div>
    <div class="container">
        <div class="qr-banking-shop">
            <img src="{{ asset("assets/img/qr-designer.png") }}" alt="">
            <div class="button">
                <a href="#" class="btn btn-scan">Quét mã</a>
                <a href="#" class="btn change-payment-method">Đổi phương thức</a>
            </div>
        </div>
        <div class="bg">
            <img src="{{ asset("assets/img/bg-banking.png") }}" alt="">
        </div>
        <div class="information-banking">
            <ul class="list-info"><h1 style="color: blueviolet">Thông tin thanh toán</h1>
                <li>Tên chủ tài khoản: <span class="text name_shop">FashionShop</span></li>
                <li>Nội dung: <span class="text id_buy">MuaHang789</span></li>
                <li> Số tài khoản: <span class="text card_id">123456789</span></li>
                <li>Tình trạng: <span class="status" style="color: red">Đang chờ xử lí ...</span></li>
                <li>Hiệu lực: <span class="text time">10:00</span></li>
            </ul>
        </div>
    </div>
    <div class="footer">
        <p style="color: gray"></p>
    </div>
</div>