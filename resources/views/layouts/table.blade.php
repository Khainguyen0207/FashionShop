@push('head')
    <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
@endpush

<div class="table-form">
    <table>
        <thead> 
            <tr class="head">
                <th>Select</th>
                @foreach ($header as $item)
                    @if ($item == null)
                        {{ $item = 'Không xác định'}}
                    @else
                        <th class="table-info">{{ $item }}</th>
                    @endif
                @endforeach
                <th>Information</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($body as $accounts)
                <tr class="body">
                    <td><input type="checkbox" name="" id=""></td>
                    @foreach ($accounts as $account)
                        @if ($account == 1 || $account == 0)
                            @if ($account == 1)
                                <td class="table-info">Quản trị viên</td>
                            @else
                                <td class="table-info">Người dùng</td>
                            @endif
                        @else
                            <td class="table-info">{{ $account}}</td>
                        @endif
                    @endforeach
                    <td>
                        <a href="">More</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>