function seen() {
    btn_carts = document.querySelectorAll('.btn-cart'); //Sự kiện click button thêm vào giỏ hàng
    btn_carts.forEach(element => {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            let url = event.currentTarget.dataset.url
            let href = event.currentTarget.href
            let option = event.currentTarget.dataset.option
            $.ajax({
                url: url+ "?" + option,
                method: 'POST',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),  
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + status);
                }
            }).then(function(data) {
                location.href = data;
            })
        });
    });

    btn_buys = document.querySelectorAll('.btn-buy'); //Sự kiện click button mua
    btn_buys.forEach(element => {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            let url = event.currentTarget.dataset.url
            let href = event.currentTarget.href
            let option = document.querySelector('.btn-cart').dataset.option
            $.ajax({
                url: url+ "?" + option,
                method: 'POST',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),  
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + status);
                }
            }).then(function(data) {
                if (option === "") {
                    location.href = data;
                } else {
                    location.href = href;
                }
            })
        });
    });
}