function Login (classButton, nameUser, namePassword) {
    this.classButton = '.' + classButton;
    this.nameUser = '[name=' + nameUser + ']';
    this.namePassword = '[name=' + namePassword + ']';
}

Login.prototype.run = function () {
    $(this.classButton).on('click', this, this.event);
};

Login.prototype.event = function (e) {
    var self = e.data;
    var user = $(self.nameUser).val();
    var password = $(self.namePassword).val();
    $.get({
        url: '/login/ajax',
        data: {
            user: user,
            password: password
        },
        dataType: 'json',
        success: function (json) {
            if (json.result !== 1) {
                alert('LOGIN OR PASSWORD');
            }
            window.location.href = '/';
        }
    });
};

$(document).ready(function () {
    var cart = new Cart('header__shop-cart-count', '.products__product');
    var login = new Login('login-form__button', 'username', 'password');
    login.run();
});