function seen() {
    btn_carts = document.querySelectorAll('.btn-cart'); //Sự kiện click button thêm vào giỏ hàng
    btn_carts.forEach(element => {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            let url = event.currentTarget.dataset.url
            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),  
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + status);
                }
            }).then(function(data) {
                const $html = $(data);
                const idValue = $html.find('#alert').html();
                $('#alert').html(idValue);
            })
        });
    });
}