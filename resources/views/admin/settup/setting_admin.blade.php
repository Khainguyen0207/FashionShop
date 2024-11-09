<h1 class="title">Cài đặt giao diện trang quản trị viên</h1>
<div class="setup-admin">
    <h3>Cài đặt sản phẩm</h3>
    <div class="product-options">
        <div class="color-options options">
            <div class="color-option option_clone data_option">
                <form action="{{route("admin.setting.edit_admin")}}" method="post" id="form_option">
                    @csrf 
                    @method('PATCH')
                    <h4 style="text-align: left"><input type="hidden" id="option_rank" name="name_option" value="color_1">Màu sắc 1</h4>
                    <div class="option option_clone">
                        <div class="name">
                            <p style="margin: 5px 0px;">Tên</p>
                            <input type="text" class="input" name="name[]">
                        </div>
                        <div class="price">
                            <p style="margin: 5px 0px;">Giá trị
                                <span class="info info_time">
                                    <i class="fa-regular fa-circle-question fa-xs" style="color: #f00000;"></i> 
                                    <span class="tooltip">Giá trị thay đổi của từng option</span>
                                </span>
                            </p>
                            <input type="number" class="input" name="value[]" value="0">
                        </div>
                        <a href="#" class="btn_action" onclick="deleteElement(event, 1)"><i class="fa-solid fa-trash"></i></a>
                    </div>
                    <a href="#" class="btn add_new">Thêm tùy chọn</a>
                    <a href="#" onclick="event.target.parentElement.submit()" class="btn">Lưu cài đặt</a>
                </form>
            </div>
            <a href="" class="btn add_new">Thêm mới</a>
        </div>  
        <div class="size-options">
            <div class="size-options options">
                <div class="size-option option_clone data_option">
                    <form action="{{route("admin.setting.edit_admin")}}" method="post" id="form_option">
                        @csrf 
                        @method('PATCH')
                        <h4 style="text-align: left"><input type="hidden" name="name_option" value="size_1">Kích thước 1</h4>
                        <div class="option option_clone">
                            <div class="name">
                                <p style="margin: 5px 0px;">Tên</p>
                                <input type="text" class="input" name="name[]">
                            </div>
                            <div class="price">
                                <p style="margin: 5px 0px;">Giá trị
                                    <span class="info info_time">
                                        <i class="fa-regular fa-circle-question fa-xs" style="color: #f00000;"></i> 
                                        <span class="tooltip">Giá trị thay đổi của từng option</span>
                                    </span>
                                </p>
                                <input type="number" class="input" name="value[]" value="0">
                            </div>
                            <a href="#" class="btn_action" onclick="deleteElement(event, 1)"><i class="fa-solid fa-trash"></i></a>
                        </div>
                        <a href="#" class="btn add_new">Thêm tùy chọn</a>
                        <a href="#" onclick="event.target.parentElement.submit()" class="btn">Lưu cài đặt</a>
                    </form>
                </div>
                <a href="" class="btn add_new">Thêm mới</a>
            </div>
        </div>
    </div>
</div>