document.querySelectorAll(".btn-action").forEach(function(button) {
    if (button.classList[0] == 'btn-del') {
        button.addEventListener("click", function(event) {
            const url = event.currentTarget.dataset.url;
            console.log(url);
            Swal.fire({
                title: 'Thông báo!',
                text: 'Bạn thực sự muốn hủy đơn hàng',
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
                    tokenInput.value = $('meta[name="csrf-token"]').attr('content');                   
                    
                    form.appendChild(methodInput);
                    form.appendChild(tokenInput);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    } else if (button.classList[0] == 'btn-edit') {
        button.addEventListener('click', function(event) {
            url = event.currentTarget.dataset.url;
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = $('meta[name="csrf-token"]').attr('content');                   
            
            form.appendChild(tokenInput);
            document.body.appendChild(form);
            form.submit();
        })
    }
})