@foreach (json_decode($option , true) as $key_item => $item)
    <div class="option option_clone">
        <div class="name">
            <p style="margin: 5px 0px;">Tên</p>
            <input type="text" class="input" name="name_{{$type}}[]" value="{{$key_item}}" required>
        </div>
        <div class="price">
            <p style="margin: 5px 0px;">Giá trị
                <span class="info info_time">
                    <i class="fa-regular fa-circle-question fa-xs" style="color: #f00000;"></i> 
                    <span class="tooltip">Giá trị thay đổi của từng option</span>
                </span>
            </p>
            <input type="number" class="input" name="value_{{$type}}[]" value="{{ $item }}" required>
        </div>
        <a href="#" class="btn_action" onclick="deleteElement(event, 1)"><i class="fa-solid fa-trash"></i></a>
    </div>
@endforeach