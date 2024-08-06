var clickCategory = true;

function clickAddCategory(event) {
    event.preventDefault();
    let data = document.getElementById('addCategory')
    if (clickCategory) {
        data.style.display = 'block'
    } else {
        data.style.display = 'none'
    }
    console.log(clickCategory);
    
    clickCategory = !clickCategory;
}