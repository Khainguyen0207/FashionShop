var clickCategory = true;
function clickAddCategory(event) {
    event.preventDefault();
    var category = document.querySelector("#addCategory")
    
    if (clickCategory) {
        category.className = "addCategory-hide"
    } else {
        category.className = "addCategory";
        var frameAddCategory = document.querySelector('#frame_addCategory');
        if (frameAddCategory.childElementCount === 0) {
            Array.from(category.childNodes).forEach(element => {
                frameAddCategory.appendChild(element)
            });
        } else {
            category.replaceChildren()
        }
    }
    clickCategory = !clickCategory;
}

function clear_text(event) {
    var category = document.getElementById('addCategory')
    document.querySelectorAll(".input").forEach(element => {
        if (element.type != "date") {
            element.value = ""
        }
    });

    if (document.querySelector("#preview")) {
        preview.childNodes.forEach(element => {
            element.remove()
            
        })
    }

    var frameAddCategory = document.querySelector('#frame_addCategory');
    if (frameAddCategory) {
        Array.from(frameAddCategory.childNodes).forEach(element => {
            category.appendChild(element)
        });
    }

    clickAddCategory(event)
}