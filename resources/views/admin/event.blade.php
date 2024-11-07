@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/categorys.css') }}">
    <style>
        .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused), .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable, .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            min-height: 200px;
        }
        .ck .ck-powered-by {
            display: none;
        }

        .info {
            position: relative;
            display: inline-block;
            cursor: pointer;

        }

        .tooltip {
            visibility: hidden;
            position: absolute;
            background-color: #555;
            color: #fff;
            border-radius: 5px;
            padding: 5px;
            width: 150px;
            bottom: 100%; /* Vị trí phía trên */
            left: 50%;
            margin-left: -75px; /* Căn giữa */
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 10px
            
        }

        .info:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
    </style>
@endpush
@section('overview')
    <div id="addCategory" class="addCategory"></div>
    <div id="frame_addCategory" style="display: none">
        <div class="screen" onclick="clickAddCategory(event)"></div>
        <form action="{{ route("admin.event.store") }}" id="addCategoryForm" enctype="multipart/form-data" class="my-animation"  method="POST">
            @csrf
            <div class="header">
                <h2 class="tittle">Sự kiện</h2>
            </div>
            <div class="container">
                <div class="information-product" style="margin-bottom: 10px;">
                    <p style="font-size: 20px; padding: 5px 0px">Tiêu đề</p>
                    <input type="text" name="title" class="input" placeholder="Tiêu đề danh mục" spellcheck="false" required>
                </div>
                <div class="timer_event">
                    <p style="font-size: 20px; padding: 5px 0px">Thời gian bắt đầu 
                        <span class="info info_time">
                            <i class="fa-regular fa-circle-question fa-xs" style="color: #f00000;"></i> 
                            <span class="tooltip">Thời gian sẽ bắt đầu lúc 00:00</span>
                        </span>
                    </p>
                    <input type="date" style="color: red;" class="input" name="start_time" id="start_time" value="{{ \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d') }}" placeholder="Thiết lập thời gian kết thúc">
                    <p style="font-size: 20px; padding: 5px 0px">Thời gian kết thúc</p>
                    <input type="date" style="color: red;" class="input" name="end_time" id="end_time" min="{{ \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->addDay()->format('Y-m-d') }}" placeholder="Thiết lập thời gian kết thúc">
                </div>
                <p style="font-size: 20px; padding: 5px 0px">Thông tin sự kiện</p>
                <div class="information_event">
                    @include('layouts.components.text_area')
                </div>
                <div class="banner_event">
                    <label for="image_select">Tải ảnh sự kiện</label>
                    <input type="file" name="image" id="image_select" style="display: none" accept="image/*">
                    <div id="preview"></div>
                    <script>
                        document.querySelector("#image_select").addEventListener("change", function(event) {
                            const file = event.currentTarget.files[0];
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
                            preview = document.querySelector("#preview")
                            preview.innerHTML= imgContainer.innerHTML
                        }) 
                    </script>
                </div>
            </div>
            <div class="footer" style="margin-top: 10px;">
                <button type="submit" class="btn-add btn"><i class="fa-solid fa-check"></i> Thêm</button>
                <button type="submit" onclick="document.querySelector('div.screen').click()" class="btn-close btn"><i class="fa-solid fa-xmark"></i> Hủy</button>
            </div>
        </form>
    </div>
    <div class="overview"> 
        <div id="header">
            <h1>Sự kiện shop</h1>
        </div>
        <div class="tool-bar">
            <div class="function">
                <a href="#" onclick="clear_text(event)" data-url="{{ route('admin.event.store') }}"> <i class="fa-solid fa-plus"></i> Sự kiện mới </a>
            </div>
        </div>
        <div class="table">
            @include("layouts.table")
        </div>
    </div>
@endsection
@push('footer')
    <script src="{{asset('assets/admin/js/event.js')}}"></script>
    <script src="{{asset('assets/js/table.js')}}"></script>
@endpush