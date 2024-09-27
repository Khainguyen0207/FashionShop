document.querySelector("#find").addEventListener("click", function(event){
    event.preventDefault()
    const node = event.currentTarget;
    const tool_bar = node.parentElement; //Get Seach in customer dashboard
    tool_bar.childNodes.forEach(element => {
        if (element instanceof HTMLInputElement) {
            if (element.value.trim() != "") {
                
            }
        }
    });
})

function find_information(value) {
    const node = document.querySelectorAll(".table-form");
}