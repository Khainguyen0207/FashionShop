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
        
        const recipient_name = document.querySelector("#recipient-name").value;
        const number_phone = document.querySelector("#number-phone").value;
        const address = document.querySelector("#address").value;

        const form = document.createElement('form');
        var ids = []
        document.querySelectorAll("#id_table_product").forEach(element => {
            var id = element.value
            console.log( element.parentElement.childNodes);
            ids.push(
                {
                    "id": id, //Lấy id từ table 
                    "name": element.parentElement.childNodes[3].textContent, //Lấy name từ table 
                    "quantity": element.parentElement.childNodes[5].textContent, //Lấy quantity từ table
                    "price_product": parseInt(element.parentElement.childNodes[7].querySelector(".total").textContent.replace(/\./g, '')), //Lấy price_product từ table
                }
            )
        });
        id_order = "id_order=" + JSON.stringify(ids)
        information_method_payment = "method_payment=" + method_payment
        information_recipient_name = "recipient_name=" + recipient_name
        information_number_phone = "number_phone=" + number_phone
        information_address = "address=" + address

        redirect_url = url + "?" + id_order + "&" + information_method_payment  + "&" + information_recipient_name + "&" + information_number_phone + "&" + information_address
        form.action = redirect_url
        form.method = "post"
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = 'amount';
        methodInput.value = document.getElementById('sum_price').value.replace(/\./g, '');

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