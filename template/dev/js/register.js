var register = new Register('register-form__button');
register.addElement('username', '^.{3,}', 'register-form__error', 'username_error', 'The user must be longer than 3 symbols');
register.addElement('password', '^.{3,}', 'register-form__error', 'password_error', 'The password must be longer than 3 symbols');
register.addElement('password2', '^.{3,}', 'register-form__error', 'password2_error', 'The password must be longer than 3 symbols');
register.addElement('email', 'test', 'register-form__error', 'email_error', 'Error');
register.addElement('first_name', 'test', 'register-form__error', 'first_name_error', 'Error');
register.addElement('last_name', 'test', 'register-form__error', 'last_name_error', 'Error');
register.checkEqual(1, 2, 'Password must by equals!');
$(document).ready(function () {
    register.run();
});