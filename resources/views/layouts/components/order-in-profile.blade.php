@push('head')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endpush

<div id="products">
    <h3 class="title">Đơn đang chờ xác nhận từ người bán</h3>
    @for ($i = 0; $i < 10; $i++)
        <div class="product">
            <ul class="information_product">
                <li class="truncate-1">Mã đơn hàng: <span class="order_code">FDHSJNVK</span></li>
                <li class="truncate-1">Số sản phẩm: <span class="quantity_product">3</span></li>
                <li class="truncate-1">Thành tiền: <span class="total">180.000 VNĐ</span></li>
                <li><a href="#" class="order_details">Nhấn để xem chi tiết đơn hàng</a></li>
                <div class="information_product_details"></div>
                <li><a href="#" class="cancel_order">Hủy đơn hàng</a></li>
            </ul>
        </div>
    @endfor
</div>