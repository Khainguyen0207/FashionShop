function update(event) {
    event.preventDefault();
    let url = event.currentTarget.dataset.url
    $.ajax({
        url: url,
        method: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),  
        },
        error: function(xhr, status, error) {
            console.log('Error');
        }
    }).then(function(data) {
        $('#hidden-list').html(data)
    })
}