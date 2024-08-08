@extends('layouts.admin')

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
    <form action="{{route('categories.store')}}" id="addCategoryForm" class="my-animation"  method="POST">
        @csrf
            <div class="header">
                <h2 class="tittle">Thêm danh mục</h2>
            </div>
            <div class="container">
                <div class="information-product">
                    <p style="font-size: 20px; padding: 5px 0px">Tên danh mục</p>
                    <input type="text" name="name_category" class="input" placeholder="Tên danh mục của bạn" spellcheck="false" required>
                    <p style="margin:5px 0; font-size: 20px">Mô tả</p>
                    <textarea maxlength="5000" class="input" style="resize: vertical;padding: 5px ;width: 100%; height: 20vh; font-size: 16px;padding: 9px 12px " spellcheck="false" placeholder="Mô tả danh mục"  name="description" ></textarea>
                </div>
                <div class="image-product">
                    <p>Hình ảnh danh mục</p>
                    <label for="upload-photo" ><i class="fa-solid fa-cloud-arrow-up"></i> Upload image</label>
                    <input type="file" id="upload-photo" required/>
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
                <button type="submit" class="btn-add btn"><i class="fa-solid fa-plus"></i> Thêm danh mục</button>
                <button type="submit" onclick="clickAddCategory(event)" class="btn-close btn"><i class="fa-solid fa-xmark"></i> Hủy</button>
            </div>
    </form>
</div>
    <div class="overview">
        <div id="header">
            <h1>Danh mục thời trang</h1>
        </div>
        <div class="tool-bar">
            <div class="">
                {{-- chưa biết thêm gì --}}
            </div>
            <div class="function">
                <a href="/" onclick="clickAddCategory(event)"> <i class="fa-solid fa-plus"></i> Thêm danh mục</a>
            </div>
        </div>

        <div class="list-categorys">
            <div class="list-fashion">
                <h3>Danh mục thời trang</h3>
                @foreach ($categories as $category)
                <ul class="nav">
                    <li>{{ $category->name_category }} <span>| <i class="icon-edit fa-solid fa-pen-to-square"></i></span></li>
                    <li class="sub-menu">
                        <a href="{{route('category.products.home', $category->id)}}">Các sản phẩm <i class="icon-arrow fa-solid fa-caret-right"></i></a>
                        <ul class="list-small">
                            <li><a href="{{route('category.products.home', $category->id)}}">Sản phẩm</a></li>
                        </ul>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
        <div class="footer">
            
        </div>
    </div>
@endsection