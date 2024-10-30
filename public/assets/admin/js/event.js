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
        data.setData('')
    });
    clickCategory = !clickCategory;
}