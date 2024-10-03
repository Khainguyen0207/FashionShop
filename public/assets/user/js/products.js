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
    })
}
let currentPage = 1;

window.addEventListener('scroll', () => {
    
});