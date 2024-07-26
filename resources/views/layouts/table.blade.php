@push('head')
    <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
    <script src="{{ asset('assets/js/table.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                            <script>
                                function deleteCustomer(event, url) {
                                    event.preventDefault();
                                    Swal.fire({
                                        title: 'Thông báo!',
                                        text: 'Bạn thực sự muốn xóa',
                                        icon: 'error',
                                        showConfirmButton: true,
                                        showCancelButton: true,
                                        confirmButtonText: 'Đồng ý',
                                        cancelButtonText: 'Từ chối',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            const form = document.createElement('form');
                                            form.method = 'POST';
                                            form.action = url;
                                            
                                            const methodInput = document.createElement('input');
                                            methodInput.type = 'hidden';
                                            methodInput.name = '_method';
                                            methodInput.value = 'DELETE';
                                            
                                            const tokenInput = document.createElement('input');
                                            tokenInput.type = 'hidden';
                                            tokenInput.name = '_token';
                                            tokenInput.value = '{{ csrf_token() }}';
                                            
                                            form.appendChild(methodInput);
                                            form.appendChild(tokenInput);
                                            
                                            document.body.appendChild(form);
                                            form.submit();
                                        }
                                    });
                                }
                            </script>
                            <a class="btn-del" href="/admin/customer/del-{{ $accounts->id }}" onclick="deleteCustomer(event, this.href)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pages">
    @if ($number != 0)
        <a class="num-page" href="/admin/customer/page-0"><i class="fa-solid fa-arrow-left"></i></a>
        <a class="num-page" href="/admin/customer/page-{{ $number -1 }}">{{ $number - 1}}</a>
    @endif
    <a class="num-page" style="background-color: #00d6eb; border-radius: 5px; color: white;"  href="/admin/customer/page-{{ $number }}">{{ $number }}</a>
    @if ($number != $maxPage)
        <a class="num-page" href="/admin/customer/page-{{ $number + 1 }}">{{ $number + 1}}</a>
        <a class="num-page"  onmouseover="window.status='your text';" href="/admin/customer/page-{{ $maxPage }}"><i class="fa-solid fa-arrow-right"></i></a>
    @endif
</div>