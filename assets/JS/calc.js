function calcCartPrice() {
   const cartItems = document.querySelectorAll('.body-table');
   const priceTotal = document.querySelector('.total-price');
   let totalPrice = 0;

   cartItems.forEach(function (item){
       const amountEl = item.querySelector('[data-counter]');
       const priceEl = item.querySelector('.cart-price');
       const currentPrice = parseInt(amountEl.innerText) * parseInt(priceEl.innerText);
       totalPrice += currentPrice;
   });
    priceTotal.innerText = totalPrice;
}