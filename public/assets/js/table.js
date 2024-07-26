function click($id) {
    document.getElementById($id).style.backgroundColor = "red";
    document.getElementById($id).style.borderRadius = "10px";
}

function selectCheckBox(body) {
    const input = body.querySelectorAll('input[type="checkbox"]');
    input.forEach(element => {
        element.checked = !element.checked;
    });
}