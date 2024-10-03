document.querySelector("#find").addEventListener("click", function(event){
    event.preventDefault()
    const node = event.currentTarget;
    const tool_bar = document.querySelector("#form_search"); //Get Seach in customer dashboard
    
    let url = node.dataset.url
    
    let query = ""
    tool_bar.childNodes.forEach(element => {
        if (element instanceof HTMLInputElement) {
            if (element.value.trim() != "") {
                if (element.name != "_token") {
                    query += element.name + "=" + element.value + "&"
                }
            }
        }
    });
    query = query.slice(0, -1);

    if (query.length != 0) {
        url = url + "?" + query
        tool_bar.action = url
        tool_bar.submit();
    }
})