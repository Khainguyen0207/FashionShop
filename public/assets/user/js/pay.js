function checkEmptyInformation() {
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
}