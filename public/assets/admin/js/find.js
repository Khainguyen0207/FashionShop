document.querySelector("#find").addEventListener("click", function(event) {
    event.preventDefault()
    const node = event.currentTarget;
    const tool_bar = document.querySelector("#form_search"); //Get Seach in customer dashboard
    let url = node.href
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
    console.log(query, url);
    if (query.length != 0) {
        url = "?" + query
        tool_bar.action = url
        tool_bar.submit();
    }
})