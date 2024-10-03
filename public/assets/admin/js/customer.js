document.querySelector("#find").addEventListener("click", function(event){
    event.preventDefault()
    const node = event.currentTarget;
    const tool_bar = document.querySelector("#form_search"); //Get Seach in customer dashboard
    
    let url = node.dataset.url
    let query = ""
    tool_bar.childNodes.forEach(element => {
        if (element instanceof HTMLInputElement) {
            if (element.value.trim() != "") {
                query += element.name + "=" + element.value + "&"
            }
        }
    });
    console.log(query);
    if (query.length != 0) {
        url = url + "?" + query
        const form = document.querySelector("#form_search")
        form.action = url
        form.submit();
    }
})