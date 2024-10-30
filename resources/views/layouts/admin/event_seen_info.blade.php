<div class="screen" onclick="clickAddCategory(event);"></div>
<form action="{{route('admin.event.store')}}" id="addCategoryForm" enctype="multipart/form-data" class="my-animation"  method="POST">
    @csrf
    <div class="header">
        <h2 class="tittle">Sự kiện</h2>
    </div>
    <div class="container">
        <div class="information-product" style="margin-bottom: 10px;">
            <p style="font-size: 20px; padding: 5px 0px">Tiêu đề</p>
            <input type="text" name="title" class="input" placeholder="Tiêu đề danh mục" spellcheck="false" value="{{$title}}" required>
        </div>
        <div class="timer_event">
            <p style="font-size: 20px; padding: 5px 0px">Thời gian bắt đầu</p>
            <input type="datetime-local" style="color: red;" class="input" name="start_time" id="start_time" value="{{ $start_time }}">
            <p style="font-size: 20px; padding: 5px 0px">Thời gian kết thúc</p>
            <input type="datetime-local" style="color: red;" class="input" name="end_time" id="end_time" value="{{ $end_time }}" placeholder="Thiết lập thời gian kết thúc">
        </div>
        <p style="font-size: 20px; padding: 5px 0px">Thông tin sự kiện</p>
        <div class="information_event">
            @include('layouts.components.text_area')
        </div>
        <div class="banner_event">
            <label for="image_select">Tải ảnh sự kiện</label>
            <input type="file" name="banner_event" id="image_select" style="display: none" accept="image/*" value="{{ Storage::url($image) }}">
            <div id="preview"><img src="{{ Storage::url($image) }}" style="width: 100%;max-width: 100px;" alt=""></div>
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
        <button type="submit" onclick="clickAddCategory(event)" class="btn-close btn"><i class="fa-solid fa-xmark"></i> Hủy</button>
    </div>
</form>