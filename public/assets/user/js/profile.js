document.querySelector("#avatar").addEventListener('click', function(event) {
    event.preventDefault()

    const url = event.currentTarget.dataset.url
    const form  = document.createElement("form");
    form.action = url
    form.method = "POST"
    form.type = "hidden"
    form.enctype= 'multipart/form-data'

    const input = document.createElement("input");
    input.name = "avatar"
    input.type = "file";
    input.accept = "image/*"
    input.click()

    const token = document.createElement("input");
    token.type = "hidden"
    token.name = "_token"
    token.value = $('meta[name="csrf-token"]').attr('content');

    form.appendChild(input);
    form.appendChild(token);
    document.body.appendChild(form)
    input.addEventListener('change', function(event) {
        const url_img = URL.createObjectURL(event.currentTarget.files[0])
        document.getElementById("avt-profile").setAttribute('src', url_img);
        form.submit()
    })
})

function hidden_product_order(event) {
    event.preventDefault()
    const animation = document.styleSheets[6];
    const li = event.currentTarget.parentNode;
    const ul = li.parentNode;
    const node = ul.querySelector(".details_animation");
    ul.querySelector(".information_product_details").style.animation = null;
   
    if (node) {
        ul.querySelector(".information_product_details").classList.remove('details_animation')
        event.currentTarget.innerHTML = "Nhấn để xem chi tiết đơn hàng"
    } else {
        ul.querySelector(".information_product_details").classList.add('details_animation')
            const newKeyframes = `
            @keyframes slow {
                0% {
                    opacity: 0;
                    max-height: 0px;
                }
                100% {
                    opacity: 1;
                    max-height: ${ul.querySelector(".details_animation").scrollHeight}px;
                }
            }
        `;
        animation.insertRule(newKeyframes, animation.cssRules.length);
        ul.querySelector(".information_product_details").style.animation = 'slow 1s forwards';
        event.currentTarget.innerHTML = "Nhấn để ẩn chi tiết đơn hàng"
    }
}

function auth(event) {
    event.preventDefault()
    url = event.currentTarget.getAttribute('href');
    query = event.currentTarget.getAttribute('id');
    $.ajax({
        url: url + "/show?auth=" + query,
        method: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),  
        },
    }).then(function(data) {
        $(".information").html(data)
    })
}

function updateEventChange() {
    document.getElementById("btn_code_confirm").disabled = true
    const inputs = document.querySelectorAll("#code");
    inputs.forEach(element => {
        element.addEventListener("input", function (event) {
            const node = event.currentTarget;
            const input = event.currentTarget.value;
            if (!isNaN(input) && input.trim() !== '') {
                if (node.nextElementSibling) {
                    node.nextElementSibling.focus()
                }
            }
            var data = []
            inputs.forEach(element => {
                data += element.value.trim()
            })
            if (data.length >= 6) {
                document.getElementById("btn_code_confirm").disabled = false
            } else {
                document.getElementById("btn_code_confirm").disabled = true
            }
        })
    });

    document.querySelector(".btn-sendmail").addEventListener("click", function(event){
        event.preventDefault()
        const email = document.querySelector("#email").value;
        const url = event.currentTarget.dataset.url + "?email=" + email
        $.ajax({
            url: url,
            method: 'post',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),  
            },
            success: (function (event) {
                event.currentTarget.style.display = "none"; // Ẩn phần tử
            })
        }).then(function(data) {
            const $html = $(data);
            const idValue = $html.find('#alert').html();
            $('#alert').html(idValue);
        })
    })
}

function order_function(event) {
    event.preventDefault()
    const node = event.currentTarget;
    event.preventDefault()
    url = event.currentTarget.getAttribute('href');
    query = event.currentTarget.getAttribute('name');
    
    $.ajax({
        url: url + "?status=" + query,
        method: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),  
        },
    }).then(function(data) {
        const div = document.createElement("div");
        div.classList.add = "information-orders";
        const $html = $(data);
        $(".late").html($html)
    })
}

function destroy(event) {
    event.preventDefault();
    const node = event.currentTarget
    
    $.ajax({
        url: node.dataset.url,
        method: "delete",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (event) {
            node.parentElement.parentElement.parentElement.remove()
        }
    }).then(function(data) {
        $('#alert').html(data);
    })
}