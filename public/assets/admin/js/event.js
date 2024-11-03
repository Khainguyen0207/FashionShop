var clickCategory = true;
function clickAddCategory(event) {
    event.preventDefault();
    var category = document.querySelector("#addCategory")
    
    if (clickCategory) {
        var frameAddCategory = document.querySelector('#frame_addCategory');
            
        if (frameAddCategory) {
            category.innerHTML = frameAddCategory.innerHTML
        }
        category.className = "addCategory-hide"
    } else {
        category.className = "addCategory";
        category.replaceChildren()
    }
    clickCategory = !clickCategory;
}

function clear_text(event) {
    var category = document.getElementById('addCategory')
    document.querySelectorAll(".input").forEach(element => {
        element.value = ""
    });

    if (document.querySelector("#preview")) {
        preview.childNodes.forEach(element => {
            element.remove()
            
        })
    }   
    clickAddCategory(event)
}