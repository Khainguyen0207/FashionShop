<div id="table">
    <div class="table-form">
        <table>
            <thead> 
                <tr class="head">
                    <th></th>
                    @foreach ($header as $item)
                        <th class="table-info">{{ $item }}</th>
                    @endforeach
                    <th>Thông tin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($body as $item)
                    @php
                        $item = collect($item)->toArray()
                    @endphp
                    <tr class="body">
                        <td><input type="checkbox"></td>
                            @foreach ($key as $k => $key_data)
                                @if (isset($item[$key_data]))
                                    <td class="table-info" name="{{$key_data}}">{{ $item[$key_data] }}</td>
                                @else
                                    <td class="table-info" name="{{$key_data}}">Không xác định</td>
                                @endif
                            @endforeach
                        <td>
                            <div class="btn">
                                @if (isset($custom_button))
                                    @foreach ($custom_button as $item_key => $item_value)
                                        <a class="btn-{{$item_key}} btn-action" title="button" data-url="/{{$item_key}}/{{ $item['id'] }}" href="#"><i class="{{$item_value}}"></i></a>
                                    @endforeach
                                @else
                                    <a class="btn-edit btn-action" title="Edit" data-url="{{ $url }}/edit/{{ $item['id'] }}" href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="btn-del btn-action" title="Delete" data-url="{{ $url }}/del/{{ $item['id'] }}" href="#"><i class="fa-solid fa-trash-can" ></i></a> 
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
            <a class="num-page" href="?page=1&email"><i class="fa-solid fa-arrow-left"></i></a>
            <a class="num-page" href="?page={{ $number - 1 }}">{{ $number - 1}}</a>
        @endif
        <a class="num-page" style="background-color: #00d6eb; border-radius: 5px; color: white;"  href="?page={{ $number }}">{{ $number }}</a>
        @if ($number != $maxPage)
            <a class="num-page" href="?page={{ $number + 1 }}">{{ $number + 1}}</a>
            <a class="num-page" href="?page={{ $maxPage }}"><i class="fa-solid fa-arrow-right"></i></a>
        @endif
    
    </div>
    @push('footer')
        <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
        <script src="{{ asset('assets/js/table.js') }}"></script> 
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
</div>