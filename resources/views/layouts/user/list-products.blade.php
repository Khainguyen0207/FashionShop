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
                    <p class="sale-price"><span class="price">{{ number_format($product->price, 0, ",", ".")}}</span> <span class="currency">VNĐ</span></p>
                </div>
                <a href="{{route('product.id', [$product->category_id , $product->id])}}" class="btn btn-seen " style="margin-bottom: 5px" data-url="{{ route('user.cart.post', $product->id) }}">Xem chi tiết</a>
                <a href="javascript:void(0);" class="btn btn-cart" data-url="{{ route('user.cart.post', $product->id) }}" data-index="{{$product->id}}" data-value="{{ route("product.getSizeAndColor" ) }}">Thêm vào giỏ hàng</a>
            </div>
        @endforeach
    </div>
</div>
<div class="seen-product">
    <input type="hidden" value="{{ $max_page }}" id="max_page" name="{{count($products)}}">
    @if ($max_page > MAX_PAGE_LOAD)
        <a href="#" id="load_products" onclick="update(event)" data-url="{{ $url }}" class="seen">Xem thêm</a> 
    @endif
</div>