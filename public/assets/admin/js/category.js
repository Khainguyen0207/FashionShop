var clickCategory = true;

function clickAddCategory(event) {
    event.preventDefault();
    var category = document.getElementById('addCategory')

    var form = document.getElementById('addCategoryForm')
    var tittle = form.querySelector('.tittle');
    tittle.innerHTML = "Thêm sản phẩm"
    var button_text = form.querySelector('.btn-add');
    button_text.innerHTML = '<i class="fa-regular fa-pen-to-square"></i> Thêm sản phẩm'
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
            size--;
        });
    }
    clickCategory = !clickCategory;
}

function clearText(element) {
    
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
