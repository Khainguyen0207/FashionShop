@push('head')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endpush

<div id="products">
    <h3 class="title">Đơn đang chờ xác nhận từ người bán</h3>
    @for ($i = 0; $i < 1; $i++)
        <div class="product">
            <ul>
                <li class="truncate-1">Mã đơn hàng: <span class="order_code">FDHSJNVK</span></li>
                <li class="truncate-1 num_product">Số sản phẩm: <span class="quantity_products">3</span></li>
                <div class="information_product_details">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="info" id="{{$i}}">
                            <div class="image_product">
                                <a href=""><img class="image" style="width: 100%; border-radius: 10px;padding-top: 5px;" src="{{asset("assets/user/img/box.png")}}" alt="anh_san_pham">
                                    <div class="screen">
                                        <p style="text-align: center; color: black">Chi tiết</p>
                                    </div></a>
                            </div>
                            <div class="information_product">
                                <li>Tên sản phẩm: <span class="name_product">Áo 3 lỗ có cổ</span></li>
                                <li style="border-top: 10px;">Thành tiền:  <span class="total-product">400.000 VNĐ</span></li>
                                <li>Số lượng : <span class="quantity-product">9</span></li>
                                <li><a href="#">Xem chi tiết sản phẩm</a></li>
                            </div>
                        </div>
                    @endfor
                </div>
                <li class="">Thành tiền: <span class="total">180.000 VNĐ</span></li>
                <li><a href="#" class="order_details">Nhấn để xem chi tiết đơn hàng</a></li>
                <li><a href="#" class="cancel_order">Hủy đơn hàng</a></li>
            </ul>
        </div>
    @endfor
</div>

@push('footer')
    
@endpush