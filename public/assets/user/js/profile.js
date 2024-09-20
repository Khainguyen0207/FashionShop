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
            if (data.length >= 4) {
                document.getElementById("btn_code_confirm").disabled = false
            } else {
                document.getElementById("btn_code_confirm").disabled = true
            }
        })
    });
}