@extends('layouts.categories.products')
@push('head')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/categorys.css') }}">
    <script src="{{asset('assets/admin/js/category.js')}}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,422&family=Roboto+Condensed:wght@504&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
@endpush
@section('overview')
    <div id="addCategory" >
        <div class="screen" onclick="clickAddCategory(event)"></div>
        <form action="{{route('category.products.store', $id)}}" class="my-animation" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="header">
                    <h2 class="tittle">Thêm sản phẩm</h2>
                </div>
                <div class="container">
                    <div class="information-product">
                        <p style="font-size: 20px; padding: 5px 0px">Tên sản phẩm</p>
                        <input type="text" name="product_name" class="input" placeholder="Tên sản phẩm của bạn" spellcheck="false" required>
                        <p style="font-size: 20px; padding: 5px 0px">Giá</p>
                        <input type="number" class="input" name="price" id="" placeholder="Giá sản phẩm" required>
                        <p style="font-size: 20px; padding: 5px 0px">Số lượng</p>
                        <input type="number" class="input" name="sold_quantity" id="" placeholder="Số lượng sản phẩm" required>
                        <p style="margin:5px 0; font-size: 20px">Mô tả sản phẩm</p>
                        <textarea maxlength="5000" class="input" style="resize: vertical;padding: 5px ;width: 100%; height: 20vh; font-size: 16px;padding: 9px 12px " spellcheck="false" placeholder="Mô tả sản phẩm của bạn"  name="description" required></textarea>
                    </div>
                    <div class="image-product">
                        <p>Hình ảnh sản phẩm</p>
                        <label for="upload-photo"><i class="fa-solid fa-cloud-arrow-up"></i> Upload image</label>
                        <input type="file" id="upload-photo" name="image" multiple/>
                        <div id="preview"></div>
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
                                    console.log(img.src);
                                    
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
        </form>
    </div>
    <div class="overview">
        <section>
            <div class="tool-bar">
                <div class="interact_product">  <!-- interact_product: tương tác sản phẩm -->
                    <div class="search_product">
                        <input type="search" name="find_product" id="" placeholder="ID Sản Phẩm" >
                        <input type="search" name="find_product" id="" placeholder="Mã Sản Phẩm" >
                        <input type="search" name="find_product" id="" placeholder="Tên Sản Phẩm" >
                        <a href="#" onclick="updating()">Tìm kiếm</a>
                    </div>
                    <div class="fill_product">
                        <!-- Hàm hiển thị số sản phẩm  -->
                    </div>
                </div>
                <div class="add_product">
                    <div class="add_product_single">
                        <a href="" onclick="clickAddCategory(event)"><i class="fa-solid fa-plus"></i> Thêm sản phẩm</a>
                    </div>
                    <div class="add_product_file">
                        <a href="#" class="update" onclick="updating()"><i class="fa-solid fa-cloud-arrow-up"></i> File</a>
                    </div>
                </div>
            </div>

            <div class="list-categorys">
                @include('layouts.table')
            </div>
        </section>
    </div>
@endsection