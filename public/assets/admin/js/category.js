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
        category.className = "addCategory-hide"
    } else {
        category.className = "addCategory";
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

function turn(clickCategory) {
    var category = document.getElementById('addCategory')
    if (clickCategory) {
        category.style.display = 'block'
    } else {
        category.style.display = 'none'
    }
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


function clickImportByExcel(event) {
    event.preventDefault()
    const url = event.currentTarget.dataset.url;

    const form = document.createElement('form')
    form.action = url
    form.method = 'post'
    form.enctype= 'multipart/form-data'

    const inputData = document.createElement('input')
    inputData.type = 'file'
    inputData.name = 'importExcel'
    inputData.accept = '.xlsx, .xls'
    inputData.id = "importExcel"
    inputData.style.opacity = '0';

    const tokenInput = document.createElement('input');
    tokenInput.type = 'hidden';
    tokenInput.name = '_token';
    tokenInput.value = $('meta[name="csrf-token"]').attr('content');
    
    inputData.click()
    form.appendChild(tokenInput)
    form.appendChild(inputData)
    document.body.appendChild(form);
    inputData.addEventListener('change', function() {
        form.submit()
    })
}