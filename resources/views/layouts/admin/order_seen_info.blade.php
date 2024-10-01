<div class="screen" onclick="clickAddCategory(event)"></div>
    <div id="addCategoryForm">
        <form action="{{ route('order.pending.edit', $id) }}"  class="my-animation" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="header">
                    <h2 class="tittle">Xem thông tin đơn hàng</h2>
                </div>
                <div class="container">
                    <div class="information-product">
                        <p style="padding: 5px 0px">Mã sản phẩm</p>
                        <input type="text" name="order_code" class="input" spellcheck="false" value="{{ $order_code }}" readonly>
                        <p style="padding: 5px 0px">Tên người nhận</p>
                        <input type="text" name="recipient_name" class="input" spellcheck="false" value="{{ $recipient_name }}" readonly>
                        <p style="padding: 5px 0px">Số điện thoại</p>
                        <input type="text" name="number_phone" class="input" spellcheck="false" value="{{ $number_phone}}" readonly>
                        <p style="padding: 5px 0px">Địa chỉ</p>
                        <input type="text" name="address" class="input" spellcheck="false" value="{{ $address   }}" readonly>
                        <h4 style="padding: 5px 0px">Chi tiết đơn hàng</h4>
                        @foreach ($order_information as $order_id => $order_value)
                            <p style=" padding: 5px 0px">Sản phẩm: <span>{{ $order_value['name'] }}</span></p>
                            <p style=" padding: 5px 0px">Thành tiền: <span>{{ number_format($order_value['price_product'], 0, ",", ".") }} VNĐ</span></p>
                            <p style=" padding: 5px 0px">Số lượng: <span>{{ $order_value['quantity']}}</span></p>
                            <p style="border-bottom: 1px solid; margin-bottom: 10px;"></p>
                        @endforeach
                        <p>Trạng thái đơn hàng: <span class="status">{{ $status }}</span></p>
                        <p>Thời gian đặt hàng: <span class="expired_at">{{ $expired_at }}</span></p>
                        <h4>Thành tiền: <span class="total">{{ number_format($total, 0, ",", ".") }} VNĐ</span> </h4>
                    </div>
                </div>
                <div class="footer">    
                    @if (!session()->get('seen'))
                        <button type="submit" class="btn-add btn"><i class="fa-solid fa-check"></i>Xác nhận đơn hàng</button>
                    @endif
                    <button ype="submit" class="btn-close btn" onclick="clickAddCategory(event)"><i class="fa-solid fa-xmark"></i>Đóng</button>
                </div>
        </form>
    </div>