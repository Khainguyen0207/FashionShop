@extends('layouts.user')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/pay.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Giỏ hàng</title>
@endpush
@section('content')
    @include('layouts.user.header')
    <div id="container">
        <div class="form-order">
            <div class="header">
                <h1 class="title pay">Thanh toán</h1>
            </div>
            <div class="content">
                <div class="recipient-information">
                    <h3 class="item">Thông tin người nhận</h3>
                    <form action="?" method="get" class="information">
                        <label for="recipient-name">Tên người nhận</label>
                        <input type="text" name="recipient_name" id="recipient-name" class="input_information" spellcheck="false" max="255" maxlength="100" required="required">
                        <label for="number-phone" >Số điện thoại</label>
                        <input type="number" name="number_phone" id="number-phone" class="input_information" max="255"  spellcheck="false" maxlength="100">
                        <input type="hidden" name="sum_price" id="sum_price" value="{{ $sum_total  }}">
                        <label for="address">Địa chỉ nhận hàng</label>
                        <input type="text" name="address" id="address" class="input_information" spellcheck="false" max="255" maxlength="100">
                    </form>
                </div>
                <div class="order-information">
                    <h3 class="item">Thông tin đơn hàng</h3>
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                        </tr>
                        @foreach ($products as $info_product_bill)
                            <tr>
                                <input type="hidden" id="id_table_product" name="id" value="{{ $info_product_bill['id'] }}">
                                <input type="hidden" id="describe" name="describe" value="{{ $info_product_bill['describe'] }}">
                                <td>{{ $info_product_bill['name'] }}</td>
                                <td>{{ $info_product_bill['quantity'] }}</td>
                                <td><span class="total">{{ number_format($info_product_bill['price_product'] , 0, ",", ".") }}</span> VNĐ</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="payment-method">
                    <h3 class="item">Phương thức thanh toán</h3>
                    <h5>Chọn phương thức thanh toán</h5>
                    <form action="" method="GET" class="select-banking">
                        <a href="" class="banking" title="Ví điện tử Momo" name="momo" onclick="select(event)"><img src="{{asset('assets/img/momo.png')}}" alt="momo"></a>
                        <a href="" class="banking" title="Ngân hàng MBank" name="MB" onclick="select(event)"><img src="{{asset('assets/img/mbbank.png')}}" alt="mbbank"></a>
                        <a href="" class="banking" title="Ngân hàng Vietcombank" name="VCB" onclick="select(event)"><img src="{{asset('assets/img/vietcombank.png')}}" alt="vietcombank"></a>
                        <a href="" class="banking" title="Ngân hàng Quốc Dân" name="NCB" onclick="select(event)"><img src="{{asset('assets/img/NCB.png')}}" alt="vietcombank"></a>
                        <a href="" class="banking action-select-banking" name="homebank" title="Thanh toán sau khi nhận hàng" onclick="select(event)"><img src="{{asset('assets/img/home-bank.png')}}" alt="home-bank"></a>
                        <script>
                            function select(event) {
                                event.preventDefault();
                                const radio = document.querySelectorAll('.banking');
                                radio.forEach(input => {
                                    input.classList.remove('action-select-banking')
                                });  
                                event.currentTarget.classList.add('action-select-banking');
                                document.getElementById('payment-method').innerHTML = event.currentTarget.title
                            }
                        </script>
                    </form>
                </div>
            </div>
            <div class="footer">
                <h3>Tổng tiền: <span class="total-number">{{ $sum_total  }}</span> <span>VNĐ</span></h3>
                <h3>Phương thức thanh toán: <span style="color: red" id="payment-method">Thanh toán sau khi nhận hàng</span></h3>
                <a href="#" class="btn btn-order" onclick="checkEmptyInformation(event)" data-url="{{ route('user.pay.order') }}">Đặt hàng</a>
            </div>
        </div>
    </div>
    @include('layouts.user.footer')
    <footer>
        <script src="{{asset('assets/user/js/pay.js')}}"></script>
    </footer>
@endsection