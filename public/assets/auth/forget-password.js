const sendmail = document.getElementById('btn-sendmail');

sendmail.addEventListener('click', function(event) {
    const url = event.currentTarget.dataset.url;
    const token = $('meta[name="csrf-token"]').attr('content');
    let url1 = url +"/" + token;
    console.log(url1);
    
    $.ajax({
        url: url1,
    }).then((data)=> {
        console.log(data);
    });
})