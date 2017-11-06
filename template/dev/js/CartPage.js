$(document).ready(function (e) {
    var cart = new Cart('header__shop-cart-count', null);
    new CartRender('shop-cart-list__center', 'shop-cart-footer-buttons__button', cart);
    $('.shop-cart-footer-buttons__button').on('click', function () {
        window.location.href = '/products';
    });
});