var register = new Register('register-form__button');
register.addElement('username', '^.{3,}', 'register-form__error', 'username_error', 'The user must be longer than 3 symbols');
register.addElement('password', '^.{3,}', 'register-form__error', 'password_error', 'The password must be longer than 3 symbols');
register.addElement('password2', '^.{3,}', 'register-form__error', 'password2_error', 'The password must be longer than 3 symbols');
register.addElement('email', '^([a-zA-Z0-9\\-_]+\\.)*[a-zA-Z0-9\\-_]+@[a-zA-Z0-9\\-_]+\\.[a-z]{2,6}$', 'register-form__error', 'email_error', 'The email is not valid');
register.addElement('first_name', '^.{1,}', 'register-form__error', 'first_name_error', 'The first name can not by empty');
register.addElement('last_name', '^.{1,}', 'register-form__error', 'last_name_error', 'The last name can not by empty');
register.checkEqual(1, 2, 'Password must by equals!');
$(document).ready(function () {
    register.run();
});