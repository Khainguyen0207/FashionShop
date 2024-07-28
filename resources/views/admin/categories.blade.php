@extends('layouts.admin')

@push('head')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/categorys.css') }}">
    <script src="{{asset('assets/admin/js/category.js')}}"></script>
@endpush
@section('overview')
    <div class="overview">
        <div id="addCategory" class="my-animation">
            <form action="{{route('categories.store')}}" method="POST">
                @csrf
                <div class="header">
                    <h2>Thêm danh mục</h2>
                </div>
                <div class="container">
                    <div class="information-product">
                        <p>Tên danh mục</p>
                        <input type="text" name="name_category" class="input" spellcheck="false" >
                        <p>Mô tả</p>
                        <textarea style="padding: 5px ;width: 100%; height: 20vh; font-size: 16px;" spellcheck="false" name="description"></textarea>
                    </div>
                    <div class="image-product">
                        <p>Hình ảnh sản phẩm</p>
                        <label for="upload-photo">Upload image</label>
                        <input type="file" id="upload-photo" />
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
                    <button type="submit" class="btn-add">Thêm danh mục</button>
                </div>
            </form>
        </div>
        <div id="header">
            <h1>Danh mục thời trang</h1>
        </div>
        <div class="tool-bar">
            <div class="">
                {{-- chưa biết thêm gì --}}
            </div>
            <div class="function">
                <a href="/" onclick="clickAddCategory(event)">Thêm danh mục</a>
            </div>
        </div>

        <div class="list-categorys">
            <div class="list-fashion">
                <h3>Danh mục thời trang</h3>
                @foreach ($categories as $category)
                <ul class="nav">
                    <li>{{ $category->name_category }} <span>| <i class="icon-edit fa-solid fa-pen-to-square"></i> </span></li>
                    <li class="sub-menu">
                        <a href="/admin/categories-{{$category->id}}">Các sản phẩm <i class="icon-arrow fa-solid fa-caret-right"></i></a>
                        <ul class="list-small">
                            <li><a href="">Quần</a></li>
                            <li><a href="">Áo</a></li>
                            <li><a href="">Giày</a></li>
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