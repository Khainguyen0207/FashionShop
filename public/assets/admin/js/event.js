var clickCategory = true;
function clickAddCategory(event) {
    event.preventDefault();
    var category = document.getElementById('addCategory')
    
    var preview = document.querySelector("div.container")
    if (clickCategory) {
        category.className = "addCategory-hide"
    } else {
        category.className = "addCategory";
    }
    document.querySelectorAll(".input").forEach(element => {
        element.value = ""
    });
    preview = event.currentTarget.parentElement.querySelector("#preview");
    if (preview) {
        preview.childNodes.forEach(element => {
            element.remove();
        })
    }
    clickCategory = !clickCategory;
}