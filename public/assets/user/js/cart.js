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
            const func1 = func.parentNode.getElementsByClassName('code')[0];
            var quantity_change = func.parentNode.getElementsByClassName('quantity-product-buy')[0].textContent;
            var table = document.getElementById(func1.textContent);
            table.childNodes[1].innerHTML = quantity_change;
            
        } catch (error) {
            // console.log("Log" + error);
        }
    });
});


// Bước 2: Cấu hình để theo dõi thay đổi nội dung
const config = { 
    attributes: true,
    attributeOldValue: true,
    attributeFilter: ['class', 'p'],
    childList: true,
    subtree: true,
    characterData: true,
    characterDataOldValue: true
};

// Bước 3: Chọn phần tử và bắt đầu theo dõi
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
            a = parseFloat(document.querySelector('span.total').textContent)
            a += parseFloat(event.currentTarget.parentNode.getElementsByClassName('sum-price')[0].textContent);
            sum.innerText = formatter.format(a * 1000);

            
            const targetNode = event.currentTarget.parentNode;
            observer.observe(targetNode, config);
        } else {
            observer.disconnect()
            let sum = document.querySelector('span.total');
            a = parseFloat(document.querySelector('span.total').textContent)
            a -= parseFloat(event.currentTarget.parentNode.getElementsByClassName('sum-price')[0].textContent);
            sum.innerText = a;
            document.getElementById(event.currentTarget.parentNode.getElementsByClassName('code')[0].textContent).remove()
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
document.querySelector('table#bill').addEventListener('change', function(event) {
    console.log(event.currentTarget);
});