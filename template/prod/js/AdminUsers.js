function globalAlerts (idContainer) {
    this.idContainer = idContainer;
    this.$container = $('#' + this.idContainer);
}

globalAlerts.prototype.render = function (type, content) {
    this.$container.empty();
    var $alert = $('<div />', { 'class': 'alert alert-' + type + ' alert-dismissible fade show', 'role': 'alert' }).html(content);
    var $button = $('<button />', { 'type': 'button', 'class': 'close', 'data-dismiss': 'alert', 'aria-label': 'Close' })
        .append($('<span />', { 'aria-hidden': 'true' }).html('&times;'));
    $alert.append($button);
    this.$container.html($alert);
    $(document).scrollTop(0);
};

function AdminUsers (idContainer) {
    var self = this;
    this.idContainer = idContainer;
    this.$container = $('#' + this.idContainer);
    this.renderUsers(1);
    this.users = [];
    this.$container
        .on('click', '.user_button_edit', function () { self.editRender($(this).attr('data-id')); })
        .on('click', '.user_button_cancel', function () { self.cancelRender($(this).attr('data-id')); })
        .on('click', '.user_button_save', function () { self.save($(this).attr('data-id')); })
}

AdminUsers.prototype.renderUsers = function (page) {
    $.get({
        url: '/admin/ajaxGetUsers',
        data: { page: page },
        dataType: 'json',
        context: this,
        success: function (json) {
            for (var i = 0; i < json.users.length; i++) {
                this.users[json.users[i].id] = json.users[i];
                this.renderUser(json.users[i]);
            }
        },
        error: function () {}
    })
};

AdminUsers.prototype.renderUser = function (user) {
    var $tr = $('<tr />');
    var $th = $('<th />', { 'scope': 'row' });
    var $td = $('<td />');
    var $buttonEdit = $('<button />', { 'type': 'button', 'class': 'btn btn-primary btn-sm user_button_edit', 'data-id': user.id }).html('edit');
    var $buttonRemove = $('<button />', { 'type': 'button', 'class': 'btn btn-danger btn-sm user_button_remove', 'data-id': user.id }).html('remove');
    if (user.username === 'admin') $buttonRemove = '';
    $tr.attr('data-id', user.id).addClass('user_row').append($th.clone().text(user.id).addClass('user_id'))
        .append($td.clone().text(user.username).addClass('user_name'))
        .append($td.clone().text(user.first_name).addClass('user_first_name'))
        .append($td.clone().text(user.last_name).addClass('user_last_name'))
        .append($td.clone().text(user.email).addClass('user_email'))
        .append($td.clone().text(user.permission_name).addClass('user_permission').attr('data-id', user.permission_id))
        .append($td.clone().addClass('user_buttons').append($buttonEdit).append(' ').append($buttonRemove));
    this.$container.append($tr);
};

AdminUsers.prototype.editRender = function (id) {
    var $row = $('.user_row[data-id=' + id + ']');
    var userFirstName = $row.find('.user_first_name').text();
    var userLastName = $row.find('.user_last_name').text();
    var userEmail = $row.find('.user_email').text();
    var userPermissionId = $row.find('.user_permission').attr('data-id');
    var $input = $('<input />', { 'class': 'form-control form-control-sm' });
    var $select = $('<select />', { 'class': 'form-control form-control-sm' });
    var $option = $('<option />');
    var $buttonSave = $('<button />', { 'type': 'button', 'class': 'btn btn-success btn-sm user_button_save', 'data-id': id }).html('save');
    var $buttonCancel = $('<button />', { 'type': 'button', 'class': 'btn btn-danger btn-sm user_button_cancel', 'data-id': id }).html('cancel');
    $row.find('.user_first_name').html($input.clone().val(userFirstName));
    $row.find('.user_last_name').html($input.clone().val(userLastName));
    $row.find('.user_email').html($input.clone().val(userEmail));
    if (this.users[id].username !== 'admin') {
        $row.find('.user_permission').html($select.clone().empty()
            .append($option.clone().attr('value', '3').text('admin'))
            .append($option.clone().attr('value', '2').text('dev'))
            .append($option.clone().attr('value', '1').text('user'))
            .val(userPermissionId)
        );
    }
    $row.find('.user_buttons').empty().append($buttonSave).append(' ').append($buttonCancel);
};

AdminUsers.prototype.cancelRender = function (id) {
    var user = this.users[id];
    var $row = $('.user_row[data-id=' + id + ']');
    var $buttonEdit = $('<button />', { 'type': 'button', 'class': 'btn btn-primary btn-sm user_button_edit', 'data-id': id }).html('edit');
    var $buttonRemove = $('<button />', { 'type': 'button', 'class': 'btn btn-danger btn-sm user_button_remove', 'data-id': id }).html('remove');
    if (user.username === 'admin') $buttonRemove = '';
    $row.find('.user_first_name').html(user.first_name);
    $row.find('.user_last_name').html(user.last_name);
    $row.find('.user_email').html(user.email);
    $row.find('.user_permission').html(user.permission_name).attr('data-id', user.permission_id);
    $row.find('.user_buttons').empty().append($buttonEdit).append(' ').append($buttonRemove);
};

AdminUsers.prototype.save = function (id) {
    var $row = $('.user_row[data-id=' + id + ']');
    var userFirstName = $row.find('.user_first_name input').val();
    var userLastName = $row.find('.user_last_name input').val();
    var userEmail = $row.find('.user_email input').val();
    var userPermissionId = $row.find('.user_permission select').val();
    var userPermissionName = $row.find('.user_permission select option:selected').text();

    if (!/^.{1,}/.test(userFirstName)) {
        globalAlerts.render('danger', '<strong>Error!</strong> The first name can not by empty');
        return false;
    }
    if (!/^.{1,}/.test(userLastName)) {
        globalAlerts.render('danger', '<strong>Error!</strong> The last name can not by empty');
        return false;
    }
    if (!/^([a-zA-Z0-9\-_]+\.)*[a-zA-Z0-9\-_]+@[a-zA-Z0-9\-_]+\.[a-z]{2,6}$/.test(userEmail)) {
        globalAlerts.render('danger', '<strong>Error!</strong> The email is not valid');
        return false;
    }

    this.users[id].first_name = userFirstName;
    this.users[id].last_name = userLastName;
    this.users[id].email = userEmail;
    this.users[id].permission_id = userPermissionId;
    this.users[id].permission_name = userPermissionName;

    $.post({
        url: '/admin/ajaxSaveUser',
        data: this.users[id],
        dataType: 'json',
        context: this,
        success: function (json) {
            if (json.result == 0) {
                globalAlerts.render('danger', '<strong>Error!</strong> ' + json.message);
                return false;
            }
            this.cancelRender(id);
            globalAlerts.render('success', '<strong>Edit save!</strong>');
        },
        error: function () {}
    });
};

$(document).ready(function () {
    window.globalAlerts = new globalAlerts('global_alerts');
    new AdminUsers('users_container');
});