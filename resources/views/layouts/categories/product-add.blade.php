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
                <input type="number" class="input" name="sold_quantity" id="" value="{{ $sold_quantity }}"  placeholder="Số lượng sản phẩm" required>
                <h3 style="font-size: 20px; padding: 5px 0px">Tùy chọn</h3>
                <p style="font-size: 20px; padding: 5px 0px">Màu sắc</p>
                <div class="color">
                    <div class="option">
                        <div class="name">
                            <label for="">Tên</label>
                            <input type="text" class="input">
                        </div>
                        <div class="price">
                            <label for="">Giá trị</label>
                            <input type="number" class="input">
                        </div>
                        <div class="action">
                            <a href="" class="btn btn_action" title="delete"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                    <a href="" class="add_new">Thêm cột mới</a>
                    <a href="" class="add_new">Sử dụng tùy chọn có sẵn</a>
                </div>
                <p style="font-size: 20px; padding: 5px 0px">Kích thước</p>
                <div class="size">
                    <div class="option">
                        <div class="name">
                            <label for="">Tên</label>
                            <input type="text" class="input" >
                        </div>
                        <div class="price">
                            <label for="">Giá trị</label>
                            <input type="number" class="input" >
                        </div>
                        <div class="btn_action">
                            <a href="" class="delete" title="delete"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                    <a href="" class="add_new">Thêm cột mới</a>
                    <a href="" class="add_new" option="size">Sử dụng tùy chọn có sẵn</a>
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