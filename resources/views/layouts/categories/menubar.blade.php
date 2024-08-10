<div class="menu-bar">
    <ul class="list-menu">
        <div class="review">
            <p>{{ $name_category }}</p>
            <a href="#logo"><img src="{{ asset('assets/admin/img/logo.png') }}" alt="logo"></a>
        </div>

        <div class="menu">
            <ul>
                <li>
                    <a href="{{route('category.products.home', $id)}}">
                        <span><i class="fa-solid fa-shop"></i> Sản phẩm thời trang</span>
                        {{-- <p><i class="icon-arrow fa-solid fa-caret-right"></i></p> --}}
                    </a>
                    <ul class="list-small">
                        {{-- Add sub-item --}}
                    </ul>
                </li>
                <li>
                    {{-- {{route('category.charts.home', $id)}} --}}
                    <a href="#" onclick="updating()">
                        <span> <i class="fa-solid fa-chart-simple"></i> Thống kê đánh giá</span>
                    </a>
                </li>
                <li>
                    {{-- {{route('category.vouchers.home', $id)}} --}}
                    <a href="#" onclick="updating()">
                        <span><i class="fa-solid fa-ticket"></i> Chương trình khuyến mãi</span>
                    </a>
                </li>
                <li>
                    <a class="btn-del btn-action"  data-url="del" href="#">
                        <span><i class="fa-solid fa-trash"></i> Xóa danh mục</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="footer-menu">
            <a href="{{ route('categories.home') }}"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
        </div>
    </ul>
</div>