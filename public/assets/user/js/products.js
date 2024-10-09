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

function cart() {
    document.querySelectorAll(".btn-cart").forEach(element => {
        element.addEventListener("click", function(event) {
            event.preventDefault()
            const div = document.querySelector(".hide_option_hidden")
            div.className = "hide_option_hide"
            const parent = event.currentTarget.parentNode

            product_name = parent.querySelector(".product_name").textContent
            sale_price = parent.querySelector(".sale-price").textContent

            div.querySelector(".product_name").innerHTML = product_name
            div.querySelector(".price").innerHTML = sale_price
        })
    });

    document.querySelector(".screen").addEventListener("click", function(event) {
        const div = document.querySelector(".hide_option_hide")
        div.className = "hide_option_hidden"

        div.querySelector(".product_name").innerHTML = ""
        div.querySelector(".price").innerHTML = ""

        btn_sizes = document.querySelectorAll('.information_btn'); //Sự kiện click button_buy
        btn_sizes.forEach(element => {
            let classname = element.classList[1]
            document.querySelectorAll(`.${classname}`).forEach(element_del => {
                element_del.classList.remove("action")
            });
        });
    })
}