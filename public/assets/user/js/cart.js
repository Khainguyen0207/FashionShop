const formatter = new Intl.NumberFormat('vi-VN', { 
    style: 'decimal',
    currency: 'VND'
  });
const products = document.querySelectorAll('#select-product');
//Tạo một đối tượng MutationObservers MutationObservers: hàm để theo dõi sự thay đổi nội dung
const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        try {
            const func = mutation.target.parentElement;
            const code = func.parentNode.getElementsByClassName('code')[0]; //id hàng table         

            var quantity_change = func.parentNode.getElementsByClassName('quantity-product-buy')[0].textContent;
            var table = document.getElementById(code.textContent);

            table.childNodes[1].innerHTML = quantity_change;  //Xử lí thay đổi số lượng
            setSumTotalForTable()
        } catch (error) {}
    });
});

function setSumTotalForTable() { //set lại giá trị sau khi thay đổi
    var sum = 0;
    const table = document.getElementById('bill');
    table.childNodes.forEach(element => {
        if (element instanceof HTMLTableRowElement) {
            const code = element.id; //id hàng table         
            const quantity = element.querySelector('td#quantity'); //giá trị của 1 sản trên hàng
            const products = document.querySelectorAll('span.code');
            products.forEach(element => {
                if (element.textContent === code) {
                    while (element.parentNode.className != "product") {
                        element = element.parentNode
                    }
                    sum += parseInt(element.getElementsByClassName('price')[0].textContent) * 1000 * parseInt(quantity.textContent)
                }
            });
        }
    });
    document.querySelector('span.total').innerHTML = formatter.format(sum);
}

const config = { 
    attributes: true,
    attributeOldValue: true,
    attributeFilter: ['class', 'p'],
    childList: true,
    subtree: true,
    characterData: true,
    characterDataOldValue: true
};

products.forEach(element => {
    element.addEventListener('click', function(event) {
        if (event.target.checked) {
            var table = document.getElementById('bill');
            var tr = document.createElement('tr');
            tr.id =  event.currentTarget.parentNode.getElementsByClassName('code')[0].textContent
            var td_name = document.createElement('td');
            td_name.textContent = table.childNodes.length - 1 + ". " + event.currentTarget.parentNode.getElementsByClassName('name')[0].textContent;
            var td_quantity = document.createElement('td');
            td_quantity.id = 'quantity'
            td_quantity.textContent = event.currentTarget.parentNode.getElementsByClassName('quantity-product-buy')[0].textContent;
            tr.appendChild(td_name)
            tr.appendChild(td_quantity)
            table.appendChild(tr)
            

            let sum = document.querySelector('span.total');
            a = parseInt(document.querySelector('span.total').textContent)
            a += parseInt(event.currentTarget.parentNode.getElementsByClassName('sum-price')[0].textContent);
            sum.innerText = formatter.format(a * 1000);

            
            const targetNode = event.currentTarget.parentNode;
            observer.observe(targetNode, config);
        } else {
            observer.disconnect()
            document.getElementById(event.currentTarget.parentNode.getElementsByClassName('code')[0].textContent).remove()
            setSumTotalForTable()

        }
    })
});
function decrease(event) {
    event.preventDefault();
    const formatter = new Intl.NumberFormat('vi-VN', { 
        style: 'decimal',
        currency: 'VND'
      });
    let product = event.currentTarget.parentNode;
    for (let index = 0; index < 2; index++) {
        product = product.parentNode;
    }
    let price = parseFloat(product.getElementsByClassName('price')[0].innerHTML, 10);
    let number = parseInt(product.getElementsByClassName('quantity-product-buy')[0].innerHTML, 10);
    if (number != 1) {
        product.getElementsByClassName('quantity-product-buy')[0].innerText = number - 1;
    }
    number = parseInt(product.getElementsByClassName('quantity-product-buy')[0].innerHTML, 10);
    product.getElementsByClassName('sum-price')[0].innerText = formatter.format(price * number * 1000);

}

function increase(event) {
    event.preventDefault();
    const formatter = new Intl.NumberFormat('vi-VN', {
        style: 'decimal',
        currency: 'VND'
      });
    let product = event.currentTarget.parentNode;
    for (let index = 0; index < 2; index++) {
        product = product.parentNode;
    }
    let price = parseFloat(product.getElementsByClassName('price')[0].innerHTML, 10);
    let number = parseInt(product.getElementsByClassName('quantity-product-buy')[0].innerHTML, 10);

    product.getElementsByClassName('quantity-product-buy')[0].innerText = number + 1;
    number = parseInt(product.getElementsByClassName('quantity-product-buy')[0].innerHTML, 10);
    product.getElementsByClassName('sum-price')[0].innerText = formatter.format(price * number * 1000);
}

function del_cart(event) {
    event.preventDefault()
    let url = event.currentTarget.dataset.url
    $.ajax({
        url: url,
        method: 'DELETE',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),  
        },
        error: function(xhr, status, error) {
            console.log('Error');
            window.location.reload();   
        }
    }).then(function(data) {
        window.location.reload();   
    })
}