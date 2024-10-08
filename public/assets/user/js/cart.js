var bill_cart = [];

const formatter = new Intl.NumberFormat('vi-VN', {
    style: 'decimal',
    currency: 'VND'
  });
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

const config = {
    attributes: true,
    attributeOldValue: true,
    attributeFilter: ['class', 'p'],
    childList: true,
    subtree: true,
    characterData: true,
    characterDataOldValue: true
};

document.querySelector('.btn-pay').addEventListener('click', function(event) { //Sự kiện click button thanh toán
    event.preventDefault();   
    let url = event.currentTarget.dataset.url
    const form = document.createElement('form');
    form.action = url
    form.method = "post"

    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = 'products';
    methodInput.value = JSON.stringify(bill_cart);
    
    const tokenInput = document.createElement('input');
    tokenInput.type = 'hidden';
    tokenInput.name = '_token';
    tokenInput.value = $('meta[name="csrf-token"]').attr('content');                   
    
    form.appendChild(methodInput);
    form.appendChild(tokenInput);

    event.currentTarget.appendChild(form);
    form.submit()
});

const products = document.querySelectorAll('#select-product');

products.forEach(element => {
    element.addEventListener('click', function(event) {  //Sự kiện click checkbox view Cart
        if (event.target.checked) {
            var table = document.getElementById('bill');

            var tr = document.createElement('tr');
            id_tr = event.currentTarget.parentNode.getElementsByClassName('code')[0].textContent;
            tr.id = id_tr

            var td_name = document.createElement('td');
            table_name = event.currentTarget.parentNode.getElementsByClassName('name')[0].textContent;
            td_name.textContent = table_name;

            var td_quantity = document.createElement('td');
            td_quantity.id = 'quantity'
            number_product = event.currentTarget.parentNode.getElementsByClassName('quantity-product-buy')[0].textContent;
            td_quantity.textContent = number_product;

            tr.appendChild(td_name)
            tr.appendChild(td_quantity)
            table.appendChild(tr)

            const targetNode = event.currentTarget.parentNode;
            observer.observe(targetNode, config);
        } else {
            observer.disconnect()
            document.getElementById(event.currentTarget.parentNode.getElementsByClassName('code')[0].textContent).remove()
        }

        setSumTotalForTable()

    })
});

function setSumTotalForTable() { //set lại giá trị sau khi thay đổi
    var sum = 0;
    bill_cart = []

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
                    price = element.getElementsByClassName('price')[0].textContent.replace(/\./g, '');
                    let price_product = parseInt(price)  * parseFloat(quantity.textContent)
                    price = element.getElementsByClassName('price')[0].textContentconst 

                    sum += price_product
                    
                    let product = {
                        id: code,
                        quantity: parseInt(quantity.textContent),
                        describe: element.getElementsByClassName('color')[0].textContent,
                        name: element.getElementsByClassName('name')[0].textContent,
                        price_product: price_product,
                    }
                    bill_cart.push(product)
                }
            });
        }
    });
    document.querySelector('span.total').innerHTML = formatter.format(sum);
}

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
    let price = product.getElementsByClassName('price')[0].textContent.replace(/\./g, '');
    let number = parseInt(product.getElementsByClassName('quantity-product-buy')[0].innerHTML, 10);
    if (number != 1) {
        product.getElementsByClassName('quantity-product-buy')[0].innerText = number - 1;
    }
    number = parseInt(product.getElementsByClassName('quantity-product-buy')[0].innerHTML, 10);
    product.getElementsByClassName('sum-price')[0].innerText = formatter.format(price * number);
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
    let price = product.getElementsByClassName('price')[0].textContent.replace(/\./g, '');
    let number = parseInt(product.getElementsByClassName('quantity-product-buy')[0].innerHTML, 10);

    number = number + 1;

    product.getElementsByClassName('sum-price')[0].innerText = formatter.format(price * number);
    product.getElementsByClassName('quantity-product-buy')[0].innerText = number
}

function del_cart(event) {
    event.preventDefault()
    const div = event.currentTarget.parentElement.parentElement
    const product_code = div.querySelector("span.code")
    let url = event.currentTarget.dataset.url
    $.ajax({
        url: url,
        method: 'DELETE',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),  
        },
    }).then(function(data) {
        const html = document.createElement('div')
        html.innerHTML = data
        const hi = html.getElementsByClassName('products-info')[0];
        $('.products-info').html(hi)
        const table = document.getElementById("bill");
        if (table.querySelector("tr#" + product_code.textContent) != undefined) {
            table.querySelector("tr#" + product_code.textContent).remove()
        } 
        setSumTotalForTable()
    })
}