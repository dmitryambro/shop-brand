function Admin() {

}

Admin.prototype.addCategory = function (name, callback) {
    $.post({
        url: '/admin/ajaxAddCategory',
        data: { name: name },
        dataType: 'json',
        success: function (json) {
            callback(json);
        },
        error: function (err) {
            callback({result: 0, message: ''});
        }
    });
};

Admin.prototype.editCategory = function (id, name, callback) {
    $.post({
        url: '/admin/ajaxEditCategory',
        data: { id: id, name: name },
        dataType: 'json',
        success: function (json) {
            callback(json);
        },
        error: function (err) {
            callback({result: 0, message: ''});
        }
    });
};

Admin.prototype.removeCategory = function (id) {

};

Admin.prototype.addSubCategory = function (idCateogry, name) {

};

Admin.prototype.changeSubCategory = function (id, name) {

};

Admin.prototype.removeSubCategory = function (id) {

};

function AdminModal(rootClass) {
    this.$modals = $(rootClass);
}

AdminModal.prototype.show = function (header, content, footer) {
    this.$modals.find('.admin__modal-header').html(header);
    this.$modals.find('.admin__modal-content').html(content);
    this.$modals.find('.admin__modal-footer').html(footer);
    this.$modals.show();
};

AdminModal.prototype.hide = function () {
    this.$modals.hide();
};

function AdminForms() {

}

AdminForms.prototype.addCategory = function () {
    var $form = $('<form />', {id: 'add_category'});
    var $label = $('<label />', {for: 'add_category_name'}).html('Category name:');
    var $input = $('<input />', {id: 'add_category_name', name: 'name', type: 'text'});
    var $button = $('<input />', {id: 'add_category_button', value: 'Add category', type: 'button'});
    return $form.append($label.append($input)).append($button);
};

AdminForms.prototype.editCategory = function (id, name) {
    var $form = $('<form />', {id: 'edit_category', 'data-id': id});
    var $label = $('<label />', {for: 'edit_category_name'}).html('Category name:');
    var $input = $('<input />', {id: 'edit_category_name', name: 'name', type: 'text', value: name});
    var $button = $('<input />', {id: 'edit_category_button', value: 'Edit category', type: 'button'});
    return $form.append($label.append($input)).append($button);
};

AdminForms.prototype.viewError = function (idFrom, idInput, errorText) {
    alert(errorText);
};

$(document).ready(function () {
    var admin = new Admin();
    var adminModal = new AdminModal('.admin__modal');
    var adminForms = new AdminForms();

    $('.add_category').on('click', function () {
        adminModal.show('Add category', adminForms.addCategory(), '');
        $('#add_category_button').on('click', function () {
            var name = $('#add_category_name').val();
            if (!/.{3,}/.test(name)) {
                return adminForms.viewError('', '', 'Name must by minimum 3 symbols')
            }
            admin.addCategory(name, function () {
                adminModal.hide();
            });
        });
    });

    $('.admin__container-categories').on('click', '.edit_category', function () {
        var id = $(this).attr('data-id');
        var $nameDiv = $(this).parent().children('.admin__container-category-name');
        var name = $nameDiv.text();
        adminModal.show('Edit category', adminForms.editCategory(id, name), '');
        $('#edit_category_button').on('click', function () {
            var name = $('#edit_category_name').val();
            if (!/.{3,}/.test(name)) {
                return adminForms.viewError('', '', 'Name must by minimum 3 symbols')
            }
            admin.editCategory(id, name, function () {
                $nameDiv.html(name);
                adminModal.hide();
            });
        });
    });
});