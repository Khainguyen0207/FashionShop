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
        const div = document.createElement("div");
        div.setAttribute('id', 'auth'); 
        document.body.appendChild(div);
    
        $("#auth").html(data)
    })
}