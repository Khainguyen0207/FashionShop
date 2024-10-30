@extends('layouts.categories.products')
@push('head')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/categorys.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,422&family=Roboto+Condensed:wght@504&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/responsize-admin.css') }}">
@endpush
@section('overview')

    <div id="addCategory" class="addCategory">
        <div class="screen" onclick="clickAddCategory(event)"></div>
        <div id="addCategoryForm">
            <form action="{{route('category.products.store', $id)}}"  class="my-animation" method="POST" enctype="multipart/form-data">
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
                                        <input type="text" class="input">
                                    </div>
                                    <div class="price">
                                        <label for="">Giá trị</label>
                                        <input type="number" class="input">
                                    </div>
                                    <div class="btn_action">
                                        <a href="" class="delete" title="delete"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </div>
                                <a href="" class="add_new">Thêm cột mới</a>
                                <a href="" class="add_new" option="size">Sử dụng tùy chọn có sẵn</a>
                            </div>
                            <p style="margin:5px 0; font-size: 20px">Mô tả sản phẩm</p>
                            <textarea class="input" style="resize: vertical;padding: 5px ;width: 100%; height: 20vh; font-size: 16px;padding: 9px 12px " spellcheck="false" 
                            placeholder="Mô tả sản phẩm" name="description" required></textarea>
                        </div>
                        <div class="image-product">
                            <p>Hình ảnh sản phẩm</p>
                            <label for="upload-photo" id="label_photo"><i class="fa-solid fa-cloud-arrow-up"></i> Upload image</label>
                            <input type="file" id="upload-photo" name="image[]" accept="image/*" multiple required/>
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
                                        console.log(img);
                                        
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
    </div>
    <div class="overview">
        <section>
            <div class="tool-bar">
                <div class="interact_product">  <!-- interact_product: tương tác sản phẩm -->
                    <div class="search_product">
                        <form action="" method="get" id="form_search">
                            <input type="text" id="product_code" name="product_code" placeholder="Mã Sản Phẩm" >
                            <input type="text" name="product_name" placeholder="Tên Sản Phẩm" >
                        </form>
                        <a href="{{ request()->fullUrl() }}" id="find" data-url=""><i class="fa-solid fa-magnifying-glass fa-xl"></i></a>
                        <a href="{{ $url }}" id="cancel" data-url=""><i class="fa-solid fa-xmark fa-xl"></i></a>
                    </div>
                    <div class="fill_product">
                        <!-- Hàm hiển thị số sản phẩm  -->
                    </div>
                </div>
                <div class="add_product">
                    <div class="add_product_single">
                        <a href="" onclick="clickAddCategory(event)" ><i class="fa-solid fa-plus"></i> Thêm sản phẩm</a>
                    </div>
                </div>
            </div>
            <div class="list-categorys">
                @include('layouts.table')
            </div>
        </section>
    </div>
@endsection
@push('footer')
    <script src="{{asset('assets/admin/js/category.js')}}"></script>
    <script src="{{ asset('assets/admin/js/find.js') }}"></script> 
    <script src="{{ asset('assets/js/table.js') }}"></script> 
@endpush