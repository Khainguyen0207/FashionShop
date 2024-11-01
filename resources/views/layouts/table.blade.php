<div id="table">
    <div class="table-form">
        <table>
            <thead> 
                <tr class="head" style="white-space: nowrap;">
                    <th class="select"></th>
                        @foreach ($header as $key_header => $item)
                            @if ($key_header == "id")
                                <th class="table-info" style="width: 5%">{{ $item }}</th>
                            @else
                                <th class="table-info">{{ $item }}</th>
                            @endif
                        @endforeach
                    <th style="white-space: nowrap;">Thông tin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($body as $item)
                    @php
                        $item = collect($item)->toArray()
                    @endphp
                    <tr class="body">
                        <td class="select"><input type="checkbox"></td>
                            @foreach ($key as $k => $key_data)
                                @if (isset($item[$key_data]))
                                    @if ($key_data == "image")
                                        <td class="table-info" name="{{$key_data}}"><img src="{{$item[$key_data]}}" alt="{{$key_data}}" style="width: 100%; max-width: 100px; max-height: 100px" ></td>
                                    @elseif($key_data == "id")
                                        <td class="table-info" style="width: 5%" name="{{$key_data}}">{{ $item[$key_data] }}</td>
                                    @else
                                        <td class="table-info" name="{{$key_data}}">{{ $item[$key_data] }}</td>
                                    @endif
                                @else
                                    <td class="table-info" name="{{$key_data}}">Không xác định</td>
                                @endif
                            @endforeach
                        <td>
                            <div class="btn">
                                @if (isset($custom_button))
                                    @foreach ($custom_button as $item_key => $item_value)
                                        <a href="#" class="btn-{{$item_key}} btn-action" title="button" data-url="{{ $url }}/{{$item_key}}/{{ $item['id'] }}" ><i class="{{$item_value}}"></i></a>
                                    @endforeach
                                @else
                                    <a href="#" class="btn-edit btn-action" title="Edit" data-url="{{ $url }}/edit/{{ $item['id'] }}" ><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#" class="btn-del btn-action" title="Delete" data-url="{{ $url }}/del/{{ $item['id'] }}" ><i class="fa-solid fa-trash-can" ></i></a> 
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pages">
        @if ($number != 1)
            <a class="num-page" href="{{ request()->fullUrlWithQuery(['page' => 1]) }}"><i class="fa-solid fa-arrow-left"></i></a>
            <a class="num-page" href="{{ request()->fullUrlWithQuery(['page' => $number - 1]) }}">{{ $number - 1}}</a>
        @endif
        <a class="num-page" style="display: inline-block;background-color: #00d6eb; border-radius: 5px; color: white;"  href="">{{ $number }}</a>
        @if ($number != $maxPage)
            <a class="num-page" href="{{ request()->fullUrlWithQuery(['page' => $number + 1]) }}">{{ $number + 1}}</a>
            <a class="num-page" href="{{ request()->fullUrlWithQuery(['page' => $maxPage]) }}"><i class="fa-solid fa-arrow-right"></i></a>
        @endif
    </div>
    @push('footer')
        <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
    @endpush
</div>