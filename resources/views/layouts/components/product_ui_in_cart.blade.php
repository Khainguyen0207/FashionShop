@push('head')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endpush

<div id="products-info">
    @if ($products != null)
    @foreach ($products as $item)
        <div class="product">
            <input style="width: 10%;max-width: 30px;" type="checkbox" name="select-product" id="select-product">
            <a href="{{route('product.id', [$item['category_id'], $item['id']])}}" class="image">
                <img class="img img-product-sale" src="{{ $item['image'][0] }}" alt="review">
                <div class="animation-img">
                    <p style="color: black">Chi tiết sản phẩm</p>
                </div>
            </a>
            <div class="informations information-product">
                <div class="truncate-1"><p class="product_name">Tên sản phẩm: <span class="name">{{ $item['product_name'] }}</span></p> </div>
                <div class="product_code"><p class="product_code">Mã sản phẩm: <span class="code">{{ $item['product_code'] }}</p> </div>
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