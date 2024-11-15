<h1 class="title">Cài đặt giao diện trang quản trị viên</h1>
<div class="setup-admin">
    <h3>Cài đặt sản phẩm</h3>
    <div class="product-options">
        <div class="color-options options">
            <div class="color-option option_clone data_option">
                <form action="{{route("admin.setting.edit_admin")}}" method="post" id="form_option" style="display: none;">
                    @csrf
                    @method('PATCH')
                    <h4 style="text-align: left">
                        <input type="hidden" name="name_option" value="colors">Màu sắc
                    </h4>
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
                    <a href="#" class="btn add_new_option">Thêm tùy chọn</a>
                    <a href="#" onclick="event.target.parentElement.submit()" class="btn">Lưu cài đặt</a>
                </form>
                @if (!empty($option_samples->first()))
                    @foreach ($option_samples as $item)
                        <form action="{{ route("admin.setting.edit_admin") }}" method="post" id="form_option" style="padding: 10px;">
                            @csrf
                            @method('PATCH')
                            <h4 style="text-align: left">
                                <input type="hidden" id="name_option" name="name_option" value="{{ $item->name }}">
                                <input type="hidden" id="id_option" name="id_option" value="{{ $item->id }}" data-url="{{ route("admin.setting.destroy", ["id" => $item->id])}}">
                                <div class="action_change">
                                    <span class="name_option">{{ $item->name }}</span>
                                    <input type="hidden" class="name_option_input" name="name_option" value="{{ $item->name }}" maxlength="100"></input>
                                    <a href="" onclick="check(event)"><i class="fa-solid fa-file-pen"></i></a>
                                    <script>
                                        var hidden = true;
                                        function check(event) {
                                            if (hidden) {
                                                event.currentTarget.parentElement.querySelector(".name_option").style.display = "none"
                                                event.currentTarget.parentElement.querySelector(".name_option_input").type = "text"

                                                hidden = !hidden
                                            } else {
                                                event.currentTarget.parentElement.querySelector(".name_option").style.display = "inline-block"
                                                event.currentTarget.parentElement.querySelector(".name_option_input").type = "hidden"
                                                hidden = !hidden
                                            }
                                        }
                                    </script>
                                </div>
                            </h4>
                            @foreach (json_decode($item->option, true) as $key => $value)
                                <div class="option option_clone">
                                    <div class="name">
                                        <p style="margin: 5px 0px;">Tên</p>
                                        <input type="text" class="input" name="name[]" value="{{$key}}">
                                    </div>
                                    <div class="price">
                                        <p style="margin: 5px 0px;">Giá trị
                                            <span class="info info_time">
                                                <i class="fa-regular fa-circle-question fa-xs" style="color: #f00000;"></i> 
                                                <span class="tooltip">Giá trị thay đổi của từng option</span>
                                            </span>
                                        </p>
                                        <input type="number" class="input" name="value[]" value="{{$value}}">
                                    </div>
                                    <a href="#" class="btn_action" onclick="deleteElement(event, 1)"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            @endforeach
                            <a href="#" class="btn add_new_option">Thêm tùy chọn</a>
                            <a href="#" onclick="event.target.parentElement.submit()" class="btn">Lưu cài đặt</a>
                        </form>
                    @endforeach
                @endif
            </div>
            <a href="" class="btn add_new">Thêm mới</a>
        </div>  
    </div>
</div>