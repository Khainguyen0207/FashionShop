@extends('layouts.user')
@push('head')
    <link rel="shortcut icon" href="{{asset('assets/user/img/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/cart.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    
    <title>Giỏ hàng</title>
@endpush
@section('content')
    @include('layouts.user.header')
    <div id="container">
        <div class="products">
            <h1 style="border-bottom: 2px lightgray solid;">Giỏ hàng</h1>
            <div class="products-info">
                @if ($products != null)
                    @foreach ($products as $item)
                        <div class="product">
                            <input style="width: 10%;" type="checkbox" name="select-product" id="select-product">
                            <a href="{{route('product.id', [$item['category_id'], $item['id']])}}" class="image">
                                <img class="img img-product-sale" src="{{ $item['image'][0] }}" alt="review">
                                <div class="animation-img">
                                    <p style="color: black">Chi tiết sản phẩm</p>
                                </div>
                            </a>
                            <div class="informations information-product">
                                <div><p class="product_name" style="color: brown;">Sản phẩm: <span style="color: black;" class="name">{{ $item['product_name'] }}</span></p> </div>
                                <div class="product_code"><p class="product_code">Mã sản phẩm: <span class="code">{{ $item['product_code'] }}</p> </div>
                                <div class="option_products"><p class="product_code">Màu sắc và kích thước: <span class="color">{{ $item['product_color'] }} - <span class="size">{{ $item['product_size'] }}</p> </div>
                                <p class="sale-price">Giá:  <span class="price">{{ number_format($item['price'], 0, ',', '.') }}</span> VNĐ </p>
                                <div class="quantity">
                                    <span>Số lượng:</span>
                                    <div class="quantity-func">
                                        <a href="#" onclick="decrease(event)"><i class="fa-solid fa-minus decrease"></i></a>
                                        <span class="quantity-product-buy" name="quantity-product-buy"> {{ $item['quantity'] }} </span>
                                        <a href="#" onclick="increase(event)"><i class="fa-solid fa-plus increase"></i></a>
                                    </div>
                                </div>
                                <p class="total">Thành tiền:  <span class="sum-price">{{ number_format($item['price'], 0, ',', '.') }}</span> VNĐ</p>
                                <div class="nav" style="display:flex; width:100%; justify-content: space-between">
                                    <a href="{{route('product.id', [$item['category_id'], $item['id']])}}" class="seen-product">Chi tiết</a>
                                    <a href="" onclick="del_cart(event)" id="del_cart" data-url="{{route('user.cart.del',[$item['id']])}}" class="seen-product">Xóa</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty">
                        <h3>Bạn chưa có sản phẩm nào</h3>
                    </div>
                @endif
            </div>
        </div>
        <div class="pay">
            <div class="header">
                <h1>Hóa đơn</h1>
            </div>
            <div class="content">
                <div class="product-add">
                    <table id="bill">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                        </tr>
                    </table>
                </div>
                <div class="total-amount">
                    <h3>Thành tiền</h3>
                    <h3><span class="total">0</span> VNĐ</h3>
                </div>
            </div>
            <div class="footer">
                {{-- <a href="#" class="btn btn-voucher" style="margin-bottom: 5px;">Voucher giảm giá</a> --}}
                <a href="#" data-url="{{ route('user.pay.post') }}" class="btn btn-pay">Thanh toán</a>
            </div>
        </div>
    </div>
    @include('layouts.user.footer')
    <footer>
        <script src="{{asset('assets/user/js/cart.js')}}"></script>
    </footer>
@endsection