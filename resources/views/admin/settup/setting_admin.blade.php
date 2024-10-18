<h1 class="title">Cài đặt giao diện trang quản trị viên</h1>
<div class="setup-admin">
    <h3>Cài đặt sản phẩm</h3>
    <div class="product-options">
        <div class="size-options options">
            <div class="size-option option">
                <h4>Màu sắc 1</h4>
                <table>
                    <tr>
                        <th>Tên</th>
                        <th>Giá trị</th>
                        <th></th>
                    </tr>
                    @for ($i = 0; $i < 2; $i++)
                        <tr>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td><a href="" class="btn btn-del">Xóa</a></td>
                        </tr>
                    @endfor
                </table>
                <div class="action">
                    <a href="" class="btn">Lưu cài đặt</a>
                    <a href="" class="btn">Thêm tùy chọn</a>
                </div>
            </div>
        </div>  
        <div class="color-options options">
            <div class="color-option option">
                <h4>Kích thước 1</h4>
                <table>
                    <tr>
                        <th>Tên</th>
                        <th>Giá trị</th>
                        <th></th>
                    </tr>
                    @for ($i = 0; $i < 2; $i++)
                        <tr>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td><a href="" class="btn btn-del">Xóa</a></td>
                        </tr>
                    @endfor
                </table>
                <div class="action">
                    <a href="" class="btn">Lưu cài đặt</a>
                    <a href="" class="btn">Thêm tùy chọn</a>
                </div>
            </div>
        </div>
    </div>
</div>
