document.querySelectorAll(".action_img").forEach(element => {
    element.addEventListener("click", function (event) {
        event.preventDefault()
        const url = event.currentTarget.href
        const node = event.currentTarget
        
        const form  = document.createElement("form");
        form.action = url
        form.method = "POST"
        form.type = "hidden"
        form.enctype= 'multipart/form-data'

        const input = document.createElement("input");
        input.name = node.childNodes[0].id
        input.type = "file";
        input.accept = "image/*"
        input.click()

        const token = document.createElement("input");
        token.type = "hidden"
        token.name = "_token"
        token.value = $('meta[name="csrf-token"]').attr('content');

        form.appendChild(input);
        form.appendChild(token);
        
        input.addEventListener('change', function(event) {
            const url_img = URL.createObjectURL(event.currentTarget.files[0])
            node.childNodes[0].setAttribute('src', url_img);
            document.body.appendChild(form)
            form.submit()
        })
    })
})

document.querySelector(".btn").addEventListener("click", function (event) {
    event.preventDefault()
    const node = event.currentTarget.parentElement.parentElement
    if (node.querySelector("#information_shop")) {
        node.querySelector("#information_shop").submit()
    }
})

document.querySelectorAll(".options").forEach(element => { //Event Delegation
    element.addEventListener("click", function (event) {
        event.preventDefault()
        if (event.target.className == "btn add_new") {
            let current = event.target;
            let node = current.parentElement;
            const option = node.querySelector("#form_option");
            const clone_option = option.cloneNode(true);
            clone_option.style.display = "block";
            clone_option.style.padding = "10px";
            node.querySelector("div.data_option").appendChild(clone_option);
        }

        if (event.target.classList.contains("add_new_option")) {
            let current = event.target;
            let node = current.parentElement;
            const option = node.querySelector(".option_clone");
            const clone_option = option.cloneNode(true);
            node.insertBefore(clone_option, current)
        }
    })
});

if (document.querySelector(".select_option_sample")) {
    let data_select = -1;
    let name_select = null;
    document.querySelectorAll(".select_option_sample").forEach(element => {
        element.addEventListener("change", function(event) {
            const node = event.currentTarget
            data_select = node.selectedIndex
            name_select = node.name
            node_apply = node.parentElement.querySelector(".apply_option_sample")
            node_apply.style.display = "inline-block"
        })

        element.parentElement.querySelector(".apply_option_sample").addEventListener("click", function(event) {
            const node = event.currentTarget
            let data = node.parentElement.querySelectorAll("option")
            console.log(data);
            
            if (data_select != -1) {
                let node_apply = event.currentTarget;
                $.ajax({
                    url: event.currentTarget.dataset.url,
                    data: {
                        id: data[data_select].value,
                        type: name_select
                    },
                }).done(function(ketqua) {
                    node.parentElement.querySelectorAll(".option_clone").forEach(element => {
                        element.remove()
                    });
                    $(node.parentElement).find(".add_new_option").before(ketqua);
                    node_apply.style.display = "none"
                }).fail(function() {console.log(node.selectedIndex);
                });
            }
        })
    })
}

function deleteElement(event, num) {
    event.preventDefault()
    let element = event.currentTarget;
    
    for (let index = 0; index < num; index++) {
        element = element.parentElement;
    }
    if (element.parentElement.querySelectorAll("div.option_clone").length > 1) {
        element.remove()
    } else {
        form = element.parentElement;
        if (form.querySelector("#id_option")) {
            Swal.fire({
                title: 'Thông báo!',
                text: 'Bạn thực sự muốn xóa cài đặt này',
                icon: 'error',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Từ chối',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.querySelector("#id_option").dataset.url,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    }).then(() => {
                        element.parentElement.remove()
                    })
                }
            });
        } else {
            // element.parentElement.remove()
            alert("Không thể xóa")
        }
    }
}

// let a = document.createElement("option")
// a.select