<div class="list-products">
    <div class="products">
        @foreach ($products as $product)
            <div class="product">
                <a href="{{ route('product.id', [$product->category_id , $product->id]) }}" class="image" style="width: 100%">
                    <img class="img img-product-sale" src="{{ $product->image[0] }}" alt="review">
                    <div class="animation-img">
                        <p style="color: black">Chi tiết sản phẩm</p>
                    </div>
                </a>
                <div class="informations information-product ">
                    <div class="truncate-1"><p class="product_name">{{ $product->product_name }}</p> </div>
                    <p class="sale-price">{{ $product->price }} VNĐ</p>
                </div>
                <a href="#" class="btn btn-buy" style="margin-bottom: 5px;">Mua ngay</a>
                <a href="#" class="btn btn-cart" >Thêm vào giỏ hàng</a>
            </div>
        @endforeach
    </div>
</div>
<div class="seen-product">
    @if (count($products) % 10 == 0)
        <a href="#" id="load_products" onclick="update(event)" data-url="{{ $url }}" class="seen">Xem thêm</a> 
    @endif
</div>