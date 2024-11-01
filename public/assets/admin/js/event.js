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
    
    clickCategory = !clickCategory;
}

function clear_text(event) {
    document.querySelectorAll(".input").forEach(element => {
        element.value = ""
    });
    if (document.querySelector("#preview")) {
        preview.childNodes.forEach(element => {
            element.remove();
        })
    }
}