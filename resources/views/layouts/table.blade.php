@push('head')
    <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/table.js')}}">
@endpush

<div class="table-form">
    <table>
        <thead> 
            <tr class="head">
                <th></th>
                @foreach ($header as $item)
                    @if ($item == null)
                        {{ $item = 'Không xác định'}}
                    @else
                        <th class="table-info">{{ $item }}</th>
                    @endif
                @endforeach
                <th>Thông tin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($body as $accounts)
                <tr class="body">
                    <td><input type="checkbox" name="" id=""></td>
                    @foreach ($accounts as $key => $account)
                        @if (($account == 1 || $account == 0) && $key == 'role')
                            @if ($account == 1 )
                                <td class="table-info">admin</td>
                            @else
                                <td class="table-info">user</td>
                            @endif
                        @else
                            <td class="table-info">{{ $account }}</td>
                        @endif
                    @endforeach
                    <td>
                        <div class="btn">
                            <a class="btn-edit" href=""><i class="fa-solid fa-pen-to-square"></i></a>
                            <a class="btn-del" href="/admin/customer/del"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pages">
    <a class="num-page" href=""><i class="fa-solid fa-arrow-left"></i></a>
    <a class="num-page" style="background-color: #00d6eb; border-radius: 5px; color: white;"  href="/admin/customer/page/0">0</a>
    <a class="num-page" id="1" href="/admin/customer/page/1" onclick="click('1')">1</a>
    <a class="num-page" href="/admin/customer/page/2">2</a>
    <a class="num-page" href=""><i class="fa-solid fa-arrow-right"></i></a>
</div>