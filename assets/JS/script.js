document.querySelector('#signup-submit').onclick = function (event){
    event.preventDefault();
    let email = document.querySelector('#email').value;
    let login = document.querySelector('#login').value;
    let name = document.querySelector('#name').value;
    let password = document.querySelector('#password').value;
    let birthdate = document.querySelector('#birthdate').value;
    let country = document.querySelector('#country').value;


    let users = {
        email : email,
        "register-login" : login,
        name : name,
        "register-password" : password,
        birthdate : birthdate,
        country : country,
    }

    fetch('/sign-up', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(users)
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                return response.json()
                    .then(res => {
                        throw new Error(JSON.stringify(res))
                    })
            }
        })
        .then(response => {
            console.log(response);
            window.location.reload();
        })
        .catch(error => {
            const errors = JSON.parse(error.message);
            for (const field in errors) {
                let el = document.querySelector(`#${field}-error`);
                if (el) {
                    for (const fieldError in errors[field]) {
                        el.innerHTML += `${errors[field][fieldError]}<br />`;
                    }
                    el.style.display = 'block';
                }
            }
        })
}

document.querySelector('#login-submit').onclick = function (event){
    event.preventDefault();
    let login = document.querySelector('#login-log').value;
    let password = document.querySelector('#password-log').value;

    let data = {
        login: login,
        password: password,
    }

    fetch('/log-in', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                return response.json()
                    .then(res => {
                        throw new Error(JSON.stringify(res))
                    })
            }
        })
        .then(response => {
            console.log(response);
            window.location.reload();
        })
        .catch(error => {
            const errors = JSON.parse(error.message);
            for (const field in errors) {
                let el = document.querySelector(`#${field}-error`);
                if (el) {
                    for (const fieldError in errors[field]) {
                        el.innerHTML += `${errors[field][fieldError]}<br />`;
                    }
                    el.style.display = 'block';
                }
            }
        })
}

$(function () {
    $('.add-to-cart').on('click', function (e){
        e.preventDefault();
        let cartData = JSON.parse(localStorage.getItem('cart') || '{}');

        const card = e.target.closest('.card');
        const productInfo = {
            id: $(this).data('id'),
            imgSrc: card.querySelector('.card-img-top').getAttribute('src'),
            title: card.querySelector('.card-title').innerText,
            info: card.querySelector('.card-text').innerText,
            price: card.querySelector('.price').innerText,
            counter: parseInt(card.querySelector('[data-counter]').innerText),
        }

        const itemInCart = cartData[productInfo.id] || null;
        if(itemInCart) {
            cartData[productInfo.id].counter += productInfo.counter;
        } else {
            cartData[productInfo.id] = productInfo;
        }

        localStorage.setItem('cart', JSON.stringify(cartData));
        if(e){
            alert('Добавлено в корзину');
        }
    });
});
$(function () {
    $('#cart-open-btn').on('click', function (e){
        let cartData = JSON.parse(localStorage.getItem('cart') || '{}');
        const cart = document.querySelector('.table.show-cart');
        cart.innerHTML = '';

        for (const productId in cartData) {
            const productInfo = cartData[productId];
            const cartItemHTML = `<table class="table show-cart" id="table">
                                <tbody class="body-table" data-id="${productInfo.id}">
                                <tr data-id="${productId}">
                                    <th><img src="${productInfo.imgSrc}" class="card-img-top" alt=""></th>
                                    <th scope="col" class="cart-title">${productInfo.title}</th>
                                    <th scope="col">${productInfo.info}</th>
                                    <th><div class="items">
                                        <div class="items__control" data-action="minus">-</div>
                                        <div class="items__current" data-counter>${productInfo.counter}</div>
                                        <div class="items__control" data-action="plus">+</div>
                                    </div></th>
                                    <th scope="col" class="cart-price">${productInfo.price}</th>
                                </tr>
                                </tbody>
                            </table>`;

            cart.insertAdjacentHTML('beforeend', cartItemHTML);

        }

        calcCartPrice();
    });
});
$(function () {
    $('.send-order').on('click', function (e){
        e.preventDefault();

        let cartData = JSON.parse(localStorage.getItem('cart') || '{}');
        if (jQuery.isEmptyObject(cartData)) {
            alert('The cart is empty');
            return;
        }

        const productsToOrder = [];

        for (const productId in cartData) {
            const product = cartData[productId];
            productsToOrder.push({
                id: product.id,
                qty: product.counter
            });
        }

        const productsPayload = JSON.stringify({
            products: productsToOrder,
        });

        const rawResponse = fetch('/orders', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: productsPayload
        });


        if(e){
            alert('Письмо отправлено');
            localStorage.removeItem('cart');
        }
    });
});
