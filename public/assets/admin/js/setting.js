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