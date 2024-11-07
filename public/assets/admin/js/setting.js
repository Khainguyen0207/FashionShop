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

document.querySelectorAll(".options").forEach(element => {
    element.addEventListener("click", function (event) {
        event.preventDefault()
        console.log(event.target);
        
        // let current = event.currentTarget;
        // let node = current.parentElement;
        // const option = node.querySelector(".option_clone");
        // const clone_option = option.cloneNode(true);
        // clone_option.addEventListener("click", function(event) {
            
        // });
        // node.insertBefore(clone_option, current);
    })
});

function deleteElement(event, num) {
    event.preventDefault()
    let element = event.currentTarget;
    
    for (let index = 0; index < num; index++) {
        element = element.parentElement;
    }

    if (element.parentElement.querySelectorAll("div.option_clone").length > 1) {
        element.remove()
    } else {
        let par = element.parentElement.parentElement.querySelectorAll("div.data_option");
        if(par && par.length > 1) {
            element.parentElement.remove()
        } else {
            Swal.fire({
                title: 'Thông báo',
                text: 'Không thể xóa option gốc',
                icon: 'error',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            });
        }
    }
}