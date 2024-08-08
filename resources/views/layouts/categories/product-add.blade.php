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
        <p style="margin:5px 0; font-size: 20px">Mô tả sản phẩm</p>
        <textarea maxlength="5000" class="input" style="resize: vertical;padding: 5px ;width: 100%; height: 20vh; font-size: 16px;padding: 9px 12px " value="" spellcheck="false" placeholder="Mô tả sản phẩm của bạn"  name="description" required>{{ $description }}</textarea>
    </div>
    <div class="image-product">
        <p>Hình ảnh sản phẩm</p>
        <label for="upload-photo"><i class="fa-solid fa-cloud-arrow-up"></i> Upload image</label>
        <input type="file" id="upload-photo" name="image[]" multiple required/>
        <div id="preview">
            @foreach ($images as $item)
                <div style="display: inline-block;"><img src="{{$item}}" style="height: 100px; max-width: 200px; display: block; margin-right: 5px; margin-bottom: 5px;"></div>
            @endforeach
        </div>
        <script>
            document.getElementById('upload-photo').addEventListener('change', function(event) {
                var files = event.target.files;
                var preview = document.getElementById('preview');
                
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
    <button type="submit" class="btn-add btn"><i class="fa-solid fa-plus"></i> Thêm sản phẩm</button>
    <button type="submit" class="btn-close btn" onclick="clickAddCategory(event)"><i class="fa-solid fa-xmark"></i> Hủy</button>
</div>