function seen() {
    btn_carts = document.querySelectorAll('.btn-cart'); //Sự kiện click button thêm vào giỏ hàng
    btn_carts.forEach(element => {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            let url = event.currentTarget.dataset.url
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

function update(event) {
    event.preventDefault();
    let url = event.currentTarget.dataset.url

    $.ajax({
        url: url,
        method: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),  
        },
        data: {
            max_page: document.querySelector("#max_page").value,
            url: document.querySelector(".seen").getAttribute("data-url"),
        }
    }).then(function(data) {
        $('#hidden-list').html(data);
        cart()
    })
}