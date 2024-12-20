<div id="products">
    @if (!empty($orders))
    <h3 class="title">{{ $title }}</h3>
        @foreach ($orders as $order)
        <div class="product" id="{{ $order['order_code'] }}">
            <ul>
                <li class="truncate-1">Mã đơn hàng: <span class="order_code">{{ $order['order_code'] }}</span></li>
                <li class="truncate-1 num_product">Số sản phẩm: <span class="quantity_products">3</span></li>
                <div class="information_product_details">
                    <li><h3 style="color: red">Chi tiết đơn hàng</h3></li>
                    <div class="information_recipient">
                        <li>Tên người nhận: <span class="recipient_name">{{ $order['recipient_name'] }}</span></li>
                        <li>Số điện thoại: <span class="number_phone">{{ $order['number_phone'] }}</span></li>
                        <li>Địa chỉ: <span class="address">{{ $order['address'] }}</span></li>
                    </div>
                    @foreach ($order['products'] as $product)
                        <div class="info" id="{{ $product['id'] }}">
                            <div class="image_product">
                                <a href="{{route('product.id', ['category_id' => $product["category_id"], 'product_id' =>  $product['product_id'] ]  )}}"><img class="image" style="width: 100%; border-radius: 10px;padding-top: 5px;" src="{{ $product['image'] }}" alt="anh_san_pham">
                                    <div class="screen">
                                        <p style="text-align: center; color: black">Chi tiết</p>
                                    </div></a>
                            </div>
                            <div class="information_product">
                                <li>Tên sản phẩm: <span class="name_product">{{ $product['name'] }}</span></li>
                                <li style="border-top: 10px;">Thành tiền:  <span class="total-product">{{ number_format($product['price_product']), 0 , '.', '.' }} VNĐ</span></li>
                                <li style="border-top: 10px;">Màu sắc và kích thước: <span class="describe">{{ $product['describe']}}</span></li>
                                <li>Số lượng : <span class="quantity-product">{{ $product['quantity'] }}</span></li>
                                <li><a href="{{route('product.id', ['category_id' => $product["category_id"], 'product_id' =>  $product['product_id'] ]  )}}">Xem chi tiết sản phẩm</a></li>
                            </div>
                        </div>
                    @endforeach
                </div>
                <li class="">Thành tiền: <span class="total">{{number_format($order['total']), 0 , '.', '.'}} VNĐ</span></li>
                <li><a href="#" class="order_details" onclick="hidden_product_order(event)">Nhấn để xem chi tiết đơn hàng</a></li>
                @if ($status == "00")
                    <li><a href="#" class="cancel_order" onclick="" data-url="" style="margin-left: 5px ">Chỉnh sửa đơn hàng</a></li>
                    <li><a href="#" class="cancel_order" onclick="destroy(event)" data-url="{{ route("profile.order.destroy", ['id' => $order['order_code']]) }}">Hủy đơn hàng</a></li>
                @endif
            </ul>
        </div>
        @endforeach
    @else
        <h3 class="title"> Không có đơn hàng nào </h3>
    @endif
</div>