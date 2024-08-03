@push('head')
    <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
    <script src="{{ asset('assets/js/table.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
@endpush

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
                <tr class="body">
                    <td><input type="checkbox"></td>
                        @foreach ($key as $key_data)
                            @if (isset($item[$key_data]))
                                <td class="table-info">{{ $item[$key_data] }}</td>
                            @else
                                <td class="table-info">Không xác định</td>
                            @endif
                        @endforeach
                    <td>
                        <div class="btn">
                            <a class="btn-edit" title="Edit" href=""><i class="fa-solid fa-pen-to-square"></i></a>
                            <a class="btn-del" title="Delete" href="#" onclick="deleteCustomer(event, '/admin/customer/del-{{ $item['id'] }}')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    </td>
                </td>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pages">
    @php
    $fullUrl = request()->url(); // Lấy URL đầy đủ
    $parsedUrl = parse_url($fullUrl, PHP_URL_PATH); // Lấy phần đường dẫn từ URL
    $baseUrl = preg_replace('/\/page-\d+$/', '', $parsedUrl); // Xóa phần `/page-1`
    $baseFullUrl = url($baseUrl); // Tạo URL đầy đủ từ đường dẫn đã cắt
    @endphp
    @if ($number != 0)
        <a class="num-page" href="{{  $baseFullUrl }}/page-0"><i class="fa-solid fa-arrow-left"></i></a>
        <a class="num-page" href="{{  $baseFullUrl }}/page-{{ $number - 1 }}">{{ $number - 1}}</a>
    @endif
    <a class="num-page" style="background-color: #00d6eb; border-radius: 5px; color: white;"  href="{{ $baseFullUrl}}/page-{{ $number }}">{{ $number }}</a>
    @if ($number != $maxPage)
        <a class="num-page" href="{{  $baseFullUrl }}/page-{{ $number + 1 }}">{{ $number + 1}}</a>
        <a class="num-page"  onmouseover="window.status='your text';" href="{{ $baseFullUrl}}/page-{{ $maxPage }}"><i class="fa-solid fa-arrow-right"></i></a>
    @endif
</div>