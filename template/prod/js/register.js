function Register (classButton) {
    this.classButton = '.' + classButton;
    this.elements = [];
    this.elementsMustByEquels = [];
}

Register.prototype.addElement = function (elementName, elementRegex, elementErrorClass, elementErrorIdText, elementErrorText) {
    this.elements.push({
        name: elementName,
        htmlName: '[name=' + elementName + ']',
        regex: new RegExp(elementRegex),
        errorClass: elementErrorClass,
        errorIdText: '#' + elementErrorIdText,
        errorText: elementErrorText
    });
};

Register.prototype.checkEqual = function (elementIndex1, elementIndex2, errorText) {
    this.elementsMustByEquels.push([elementIndex1, elementIndex2, errorText]);
};

Register.prototype.run = function () {
    $(this.classButton).on('click', this, this.event);
};

Register.prototype.event = function (e) {
    var self = e.data;
    var data = [];
    var jsonData = {};
    var elements = self.elements.filter(function (element) {
        var value = $(element.htmlName).val();
        data.push(value);
        jsonData[element.name] = value;
        if (element.regex.test(value)) {
            $(element.htmlName).removeClass(element.errorClass);
            $(element.errorIdText).empty();
            return false;
        }
        $(element.htmlName).addClass(element.errorClass);
        $(element.errorIdText).html(element.errorText);
        return true;
    });
    if (elements.length === 0) {
        for (var i = 0; i < self.elementsMustByEquels.length; i++) {
            var equals = self.elementsMustByEquels[i];
            if (data[equals[0]] !== data[equals[1]]) {
                alert(equals[2]);
                return false;
            }
        }
        $.post({
            url: '/register/ajax',
            data: jsonData,
            dataType: 'json',
            success: function (json) {
                if (json.result !== 1) {
                    alert(json.resultMessage);
                    return false;
                }
                window.location.href = '/';
            }
        })
    }
};

$(document).ready(function () {
    var cart = new Cart('header__shop-cart-count', '.products__product');
    var register = new Register('register-form__button');
    register.addElement('username', '^.{3,}', 'register-form__error', 'username_error', 'The user must be longer than 3 symbols');
    register.addElement('password', '^.{3,}', 'register-form__error', 'password_error', 'The password must be longer than 3 symbols');
    register.addElement('password2', '^.{3,}', 'register-form__error', 'password2_error', 'The password must be longer than 3 symbols');
    register.addElement('email', '^([a-zA-Z0-9\\-_]+\\.)*[a-zA-Z0-9\\-_]+@[a-zA-Z0-9\\-_]+\\.[a-z]{2,6}$', 'register-form__error', 'email_error', 'The email is not valid');
    register.addElement('first_name', '^.{1,}', 'register-form__error', 'first_name_error', 'The first name can not by empty');
    register.addElement('last_name', '^.{1,}', 'register-form__error', 'last_name_error', 'The last name can not by empty');
    register.checkEqual(1, 2, 'Password must by equals!');
    register.run();
});