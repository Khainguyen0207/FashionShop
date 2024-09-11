function checkEmptyInformation(event) {
    const information = document.querySelectorAll('.input_information');
    information.forEach(element => {
        if (element.value.trim(element.value) == "") {
            element.classList.add('error-input');

            const alert = document.createElement('div');
            alert.className = "alert alert-danger my-animation-alert"
            const span = document.createElement('span');
            span.textContent = "Vui lòng nhập đầy đủ thông tin"
            alert.appendChild(span)
            const alert_parent = document.getElementById('alert');
            alert_parent.appendChild(alert)

            element.addEventListener('change', function(event) {
                if (element.value.trim(element.value) != "") {
                    element.classList.remove('error-input');
                }
            })
        } else {
            element.classList.remove('error-input');
        }
    });

    if (document.querySelectorAll('.error-input').length == 0) {
        event.preventDefault();
        const method_payment = document.querySelector(".action-select-banking").getAttribute('name');
        let url = event.currentTarget.dataset.url
        let url_cart = event.currentTarget.dataset.cart
        const form = document.createElement('form');
        if (method_payment == "homebank") {
            var ids = []
            document.querySelectorAll("#id_table_product").forEach(element => {
                var id = element.value
                ids.push(id)
            });
            form.action = url_cart + "?id_del=" + JSON.stringify(ids)
        } else {
            form.action = url
        }
        form.method = "post"
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = 'amount';
        methodInput.value = document.getElementById('sum_price').value;

        const tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = $('meta[name="csrf-token"]').attr('content');                   

        event.currentTarget.appendChild(form);
        form.appendChild(methodInput);
        form.appendChild(tokenInput);
        form.submit()
    };
}

