const formatter = new Intl.NumberFormat('vi-VN', {
    style: 'decimal',
    currency: 'VND'
  });
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
            if (div) {
                div.className = "hide_option_hide"
            }
            const parent = event.currentTarget.parentNode
            const url = event.currentTarget.dataset.url
            const value = event.currentTarget.dataset.value
            const index = event.currentTarget.dataset.index
            
            product_name = parent.querySelector(".product_name").textContent
            let sale_price = parseInt(parent.querySelector(".price").textContent.replace(/\./g, ''));
            document.querySelector("#cart").setAttribute("data-url", url);
            div.querySelector(".product_name").innerHTML = product_name
            div.querySelector(".price").innerHTML = formatter.format(sale_price);
            div.querySelector(".currency").innerHTML = "VNĐ"
            $.ajax({
                url: value,
                data : {
                    id: index
                }
            }).done((res) => {
                const colors = JSON.parse(res.colors);
                node_colors = div.querySelector("div.type.color")
                Object.entries(colors).map(([key, value]) => {
                    let a = document.createElement("a")
                    a.href = "#"
                    a.className = "information_btn btn_color"
                    a.dataset.value = value
                    a.textContent = key
                    a.addEventListener('click', function(event) {
                        event.preventDefault();
                        let classname = event.currentTarget.classList[1] //get class button click
                        
                        document.querySelectorAll(`.${classname}`).forEach(element_del => {
                            element_del.classList.remove("action")
                        });

                        a.classList.add("action");
                        let button = document.querySelector("#cart");
                        const color = document.querySelector('.btn_color.action')?.textContent ?? "";
                        const size = document.querySelector('.btn_size.action')?.textContent ?? "";
                        update_value_money(div, parent)
                        let price = div.querySelector(".price").textContent.replace(/\./g, "")
                        button.setAttribute("data-option", `color=${color}&size=${size}&price=${price}`);
                    });
                    node_colors.appendChild(a)
                });

                const sizes = JSON.parse(res.sizes);
                node_sizes = div.querySelector("div.type.size")
                Object.entries(sizes).map(([key, value]) => {
                    let a = document.createElement("a")
                    a.href = "#"
                    a.className = "information_btn btn_size"
                    a.dataset.value = value
                    a.textContent = key
                    a.addEventListener('click', function(event) {
                        event.preventDefault();
                        let classname = event.currentTarget.classList[1] //get class button click
                        
                        document.querySelectorAll(`.${classname}`).forEach(element_del => {
                            element_del.classList.remove("action")
                        });
                        a.classList.add("action");
                        const button = document.querySelector("#cart");
                        const color = document.querySelector('.btn_color.action')?.textContent ?? "";
                        const size = document.querySelector('.btn_size.action')?.textContent ?? "";
                        update_value_money(div, parent)
                        let price = div.querySelector(".price").textContent.replace(/\./g, "")
                        button.setAttribute("data-option", `color=${color}&size=${size}&price=${price}`);
                    });
                    node_sizes.appendChild(a)
                });
            })
        })
    });
}

function update_value_money(div, parent) {
    div.querySelectorAll(".action").forEach(element => {
        let sale_price_current = parseInt(parent.querySelector(".price").textContent.replace(/\./g, ''));
        div.querySelector(".price").innerHTML = formatter.format(sale_price_current + parseInt(element.dataset.value));
    });
}

document.querySelector(".screen").addEventListener("click", function(event) {
    const div = document.querySelector(".hide_option_hide")
    if (div) {
        div.className = "hide_option_hidden"
    }
    div.querySelector(".product_name").innerHTML = ""
    div.querySelector(".price").innerHTML = ""
    
    btn_sizes = document.querySelectorAll('.information_btn'); //Sự kiện click button_buy
    btn_sizes.forEach(element => {
        let classname = element.classList[1]
        document.querySelectorAll(`.${classname}`).forEach(element_del => {
            element_del.classList.remove("action")
        });
    });
    div.querySelector("div.type.color").replaceChildren()
    div.querySelector("div.type.size").replaceChildren()
})

function addCart(event) {
    event.preventDefault();
    let url = event.currentTarget.dataset.url
    let option = event.currentTarget.dataset.option
    console.log(url + "?" + option);
    $.ajax({
        url: url+ "?" + option,
        method: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),  
        }
    }).then(function(data) {
        location.href = data;
    })
}