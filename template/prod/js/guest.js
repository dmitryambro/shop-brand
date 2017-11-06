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