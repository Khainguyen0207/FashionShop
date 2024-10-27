var clickCategory = true;
function clickAddCategory(event) {
    event.preventDefault();
    var category = document.getElementById('addCategory')
    
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