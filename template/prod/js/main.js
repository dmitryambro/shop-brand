$(document).ready(function (e) {
    $('.shop-cart-total__button').click(function (e) {
        window.location = "./checkout.html";
    });
    var cart = new Cart('header__shop-cart-count', '.products__product');
});