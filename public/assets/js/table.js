function click($id) {
    document.getElementById($id).style.backgroundColor = "red";
    document.getElementById($id).style.borderRadius = "10px";
}

function deleteCustomer(event, url) {
    event.preventDefault();
    if (confirm('Are you sure you want to delete this customer?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        const tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = '{{ csrf_token() }}';
        
        form.appendChild(methodInput);
        form.appendChild(tokenInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}