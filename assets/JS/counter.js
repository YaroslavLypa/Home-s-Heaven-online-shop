window.addEventListener('click', function (event) {
    let counter;
    let productId;

    let cartData = JSON.parse(localStorage.getItem('cart') || '{}');
    if (event.target.dataset.action === 'plus' || event.target.dataset.action === 'minus') {
        const counterWrapper = event.target.closest('.items');
        counter = counterWrapper.querySelector('[data-counter]');
        productId = event.target.closest('tr')?.dataset?.id;
    }

    if (event.target.dataset.action === 'plus') {
        counter.innerText = ++counter.innerText;

        if (productId && cartData[productId]) {
            cartData[productId].counter++;
        }
    }

    if (event.target.dataset.action === 'minus') {
        if (parseInt(counter.innerText) > 1) {
            counter.innerText = --counter.innerText;

            if (productId && cartData[productId]) {
                cartData[productId].counter--;
            }
        } else if (event.target.closest('.table') && parseInt(counter.innerText) === 1) {
            event.target.closest('.body-table').remove();
            delete cartData[productId];
            calcCartPrice();
        }
    }

    if (productId) {
        localStorage.setItem('cart', JSON.stringify(cartData));
    }

    if (event.target.hasAttribute('data-action') && event.target.closest('.table')) {
        calcCartPrice();
    }
});