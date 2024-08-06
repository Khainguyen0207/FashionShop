var clickCategory = true;

function clickAddCategory(event) {
    event.preventDefault();
    var category = document.getElementById('addCategory')
    var getInformation = document.querySelector('.information-product');
    getInformation.childNodes.forEach(element => {
        if (element instanceof HTMLInputElement || element instanceof HTMLTextAreaElement) {
            element.value = ''
        }
    });
    
    var preview = document.getElementById('preview')
    if (clickCategory) {
        category.style.display = 'block'
    } else {
        category.style.display = 'none'
    }
    let size = preview.childNodes.length
    while (size != 0) {
        preview.childNodes.forEach(element => {
            element.remove()
            console.log("Size: " + size);
            size--;
        });
    }
    clickCategory = !clickCategory;
}

function updating() {
    Swal.fire({
        title: 'Thông báo',
        text: 'Tính năng đang được cập nhật',
        icon: 'info',
        showConfirmButton: true,
        confirmButtonText: 'Đồng ý',
    });
}
