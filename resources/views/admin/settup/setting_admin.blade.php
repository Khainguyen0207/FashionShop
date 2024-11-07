<h1 class="title">Cài đặt giao diện trang quản trị viên</h1>
<div class="setup-admin">
    <h3>Cài đặt sản phẩm</h3>
    <div class="product-options">
        <div class="color-options options">
            <div class="color-option option_clone data_option">
                <h4>Màu sắc 1</h4>
                <div class="option option_clone">
                    <form action="{{route("admin.setting.edit")}}" method="post" class="option">
                        @csrf   
                        <div class="name">
                            <p style="margin: 5px 0px;">Tên</p>
                            <input type="text" class="input" name="name_color[]">
                        </div>
                        <div class="price">
                            <p style="margin: 5px 0px;">Giá trị
                                <span class="info info_time">
                                    <i class="fa-regular fa-circle-question fa-xs" style="color: #f00000;"></i> 
                                    <span class="tooltip">Giá trị thay đổi của từng option</span>
                                </span>
                            </p>
                            <input type="number" class="input" name="value_color[]">
                        </div>
                        <a href="#" class="btn_action" onclick="deleteElement(event, 2)"><i class="fa-solid fa-trash"></i></a>
                    </form>
                </div>
                <a href="#" class="btn add_new">Thêm tùy chọn</a>
                <a href="#" onclick="document.querySelector('form.option').submit()" class="btn">Lưu cài đặt</a>
            </div>
            <a href="" class="btn add_new">Thêm mới</a>
        </div>  
        <div class="size-options options">
            <div class="size-option">
                <h4>Kích thước 1</h4>
                <div class="option">
                    <div class="name">
                        <p style="margin: 5px 0px;">Tên</p>
                        <input type="text" class="input" name="name_size[]">
                    </div>
                    <div class="price">
                        <p style="margin: 5px 0px;">Giá trị
                            <span class="info info_time">
                                <i class="fa-regular fa-circle-question fa-xs" style="color: #f00000;"></i> 
                                <span class="tooltip">Giá trị thay đổi của từng option</span>
                            </span>
                        </p>
                        <input type="number" class="input" name="value_size[]">
                    </div>
                    <a href="#" class="btn_action" onclick="deleteElement(event, 1)"><i class="fa-solid fa-trash"></i></a>
                </div>
                <a href="" class="btn add_new">Thêm tùy chọn</a>
            </div>
            <a href="" class="btn">Lưu cài đặt</a>
            <a href="" class="btn">Thêm mới</a> 
        </div>
    </div>
</div>