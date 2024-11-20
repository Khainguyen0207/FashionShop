<div class="screen" onclick="clickAddCategory(event)"></div>
<div id="addCategoryForm">
    <form action="{{ route('category.products.update', [$category_id, $id])}}"  class="my-animation" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="header">
            <h2 class="tittle">{{ $title }}</h2>
        </div>
        <div class="container">
            <div class="information-product">
                <p style="font-size: 20px; padding: 5px 0px">Tên sản phẩm</p>
                <input type="text" name="product_name" class="input" value="{{ $product_name }}" placeholder="Tên sản phẩm của bạn" spellcheck="false" required>
                <p style="font-size: 20px; padding: 5px 0px">Giá</p>
                <input type="number" class="input" name="price" id="" value="{{ $price }}" placeholder="Giá sản phẩm" required>
                <p style="font-size: 20px; padding: 5px 0px">Số lượng</p>
                <input type="number" class="input" name="unsold_quantity" id="" value="{{ $unsold_quantity }}"  placeholder="Số lượng sản phẩm" required>
                 {{-- div color --}}
                <div class="color-options options" style="padding: 2px">
                    <div class="color-option option_clone data_option">
                        <input type="hidden" name="name_option" value="colors">
                        <p style="text-align: left">
                            Màu sắc
                        </p>
                        @foreach (json_decode($colors, true) as $key_color => $value_color)
                        <div class="option option_clone">
                            <div class="name">
                                <p style="margin: 5px 0px;">Tên</p>
                                <input type="text" class="input" name="name_color[]" value="{{ $key_color }}" required>
                            </div>
                            <div class="price">
                                <p style="margin: 5px 0px;">Giá trị
                                    <span class="info info_time">
                                        <i class="fa-regular fa-circle-question fa-xs" style="color: #f00000;"></i> 
                                        <span class="tooltip">Giá trị thay đổi của từng option</span>
                                    </span>
                                </p>
                                <input type="number" class="input" name="value_color[]" value="{{ $value_color }}">
                            </div>
                            <a href="#" class="btn_action" onclick="deleteElement(event, 1)"><i class="fa-solid fa-trash"></i></a>
                        </div>
                        @endforeach
                        <a href="#" class="btn btn_action add_new_option">Thêm tùy chọn</a>
                        <select class="btn btn_action select_option_sample" name="color" style="background-color: transparent">
                            <option value="0">Sử dụng mẫu sẵn</option>
                            @foreach ($options as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <a href="#" class="btn btn_action apply_option_sample" onclick="" style="display: none" data-url="{{ route("admin.setting.upload_settup_sample") }}">Áp dụng</a>
                    </div>
                </div>
                {{-- div size --}}
                <div class="size-options options" style="padding: 2px">
                    <div class="size-option option_clone data_option">
                        <input type="hidden" name="name_option" value="sizes">
                        <p style="text-align: left">
                            Kích thước
                        </p>
                        @foreach (json_decode($sizes, true) as $key_size => $value_size)
                        <div class="option option_clone">
                            <div class="name">
                                <p style="margin: 5px 0px;">Tên</p>
                                <input type="text" class="input" name="name_size[]" value="{{ $key_size }}" required/>
                            </div>
                            <div class="price">
                                <p style="margin: 5px 0px;">Giá trị
                                    <span class="info info_time">
                                        <i class="fa-regular fa-circle-question fa-xs" style="color: #f00000;"></i> 
                                        <span class="tooltip">Giá trị thay đổi của từng option</span>
                                    </span>
                                </p>
                                <input type="number" class="input" name="value_size[]" value="{{ $value_size }}">
                            </div>
                            <a href="#" class="btn_action" onclick="deleteElement(event, 1)"><i class="fa-solid fa-trash"></i></a>
                        </div>
                        @endforeach
                        <a href="#" class="btn btn_action add_new_option">Thêm tùy chọn</a>
                        <select class="btn btn_action select_option_sample" name="size" style="background-color: transparent">
                            <option value="-1">Sử dụng mẫu sẵn</option>
                            @foreach ($options as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <a href="#" class="btn btn_action apply_option_sample" onclick=""  style="display: none" data-url="{{ route("admin.setting.upload_settup_sample") }}">Áp dụng</a>
                    </div>
                </div> 
                <p style="margin:5px 0; font-size: 20px">Mô tả sản phẩm</p>
                <textarea maxlength="5000" class="input" style="resize: vertical;padding: 5px ;width: 100%; height: 20vh; font-size: 16px;padding: 9px 12px " value="" spellcheck="false" placeholder="Mô tả sản phẩm của bạn"  name="description" required>{{ $description }}</textarea>
            </div>
            <div class="image-product">
                <p>Hình ảnh sản phẩm</p>
                <label for="upload-photo" id="label_photo"><i class="fa-solid fa-cloud-arrow-up"></i> Upload image</label>
                <input type="file" id="upload-photo" name="image[]" multiple/>
                <div id="preview">
                    @foreach ($image as $item)
                        <div style="display: inline-block;"><img src="{{ $item }}" style="height: 100px; max-width: 200px; display: block; margin-right: 5px; margin-bottom: 5px;"></div>
                    @endforeach
                </div>
                <script>
                    document.getElementById('upload-photo').addEventListener('change', function(event) {
                        var files = event.target.files;
                        var preview = document.getElementById('preview');
                        console.log(preview);
                        
                        // Clear any existing content
                        preview.innerHTML = '';
                    
                        // Loop through all selected files
                        for (var i = 0; i < files.length; i++) {
                            var file = files[i];
                            
                            // Only process image files
                            if (!file.type.match('image.*')) {
                                continue;
                            }
                            
                            var imgContainer = document.createElement('div');
                            imgContainer.style.display = 'inline-block';
                            var img = document.createElement('img');
                            img.src = URL.createObjectURL(file);
                            img.style.height = '100px';
                            img.style.maxWidth = '200px';
                            img.style.display = 'block';
                            img.style.marginRight = '5px';
                            img.style.marginBottom = '5px';
                            imgContainer.appendChild(img);
                            preview.appendChild(imgContainer);
                        }
                    });
                </script>
            </div>
        </div>
        <div class="footer">    
            <button type="submit" class="btn-add btn"><i class="fa-regular fa-pen-to-square"></i> Cập nhật </button>
            <button type="submit" class="btn-close btn" onclick="clickAddCategory(event)"><i class="fa-solid fa-xmark"></i> Hủy</button>
        </div>
    </form>
</div>
<footer>
    <script src="{{ asset('assets/admin/js/setting.js') }}"></script> 
</footer>