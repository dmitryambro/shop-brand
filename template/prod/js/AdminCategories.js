function AdminCategories () {
    $('#categories')
        /* category */
        .on('click', '.add_category', function (e) {
            var modalId = 'add_category_modal';
            $('#' + modalId + '_error_1').hide();
            $('#' + modalId + '_name').val('');
            $('#' + modalId).modal('show');
        })
        .on('click', '.edit_category', function (e) {
            var modalId = 'edit_category_modal';
            $('#' + modalId + '_error_1').hide();
            $('#' + modalId + '_name').val($(this).parent().children('.category_name').text());
            $('#' + modalId).modal('show');
            $('#' + modalId).attr('data-id', $(this).attr('data-id'));
        })
        .on('click', '.remove_category', function (e) {
            var modalId = 'remove_category_modal';
            $('#' + modalId).modal('show');
            $('#' + modalId).attr('data-id', $(this).attr('data-id'));
        })
        /* sub category */
        .on('click', '.add_sub_category', function (e) {
            var modalId = 'add_sub_category_modal';
            $('#' + modalId + '_error_1').hide();
            $('#' + modalId + '_name').val('');
            $('#' + modalId).modal('show');
            $('#' + modalId).attr('data-id', $(this).attr('data-id'));
        })
        .on('click', '.edit_sub_category', function (e) {
            var modalId = 'edit_sub_category_modal';
            $('#' + modalId + '_error_1').hide();
            $('#' + modalId + '_name').val($(this).parent().children('.sub_category_name').text());
            $('#' + modalId).modal('show');
            $('#' + modalId).attr('data-id', $(this).attr('data-id'));
        })
        .on('click', '.remove_sub_category', function (e) {
            var modalId = 'remove_sub_category_modal';
            $('#' + modalId).modal('show');
            $('#' + modalId).attr('data-id', $(this).attr('data-id'));
        });

    $('#add_category_modal_btn_save').on('click', this, this.addCategorySave);
    $('#edit_category_modal_btn_save').on('click', this, this.editCategorySave);
    $('#remove_category_modal_btn_save').on('click', this, this.removeCategorySave);

    $('#add_sub_category_modal_btn_save').on('click', this, this.addSubCategorySave);
    $('#edit_sub_category_modal_btn_save').on('click', this, this.editSubCategorySave);
    $('#remove_sub_category_modal_btn_save').on('click', this, this.removeSubCategorySave);
}

AdminCategories.prototype.editSubCategoryModalOpen = function (e) {
};

AdminCategories.prototype.addCategorySave = function (e) {
    var modalId = 'add_category_modal';
    var name = $('#' + modalId + '_name').val();
    if (!/.+/.test(name)) {
        $('#' + modalId + '_error_1').show();
        return false;
    }
    $.post({
        url: '/admin/ajaxAddCategory',
        data: {name: name},
        dataType: 'json',
        success: function (data) {
            if (data.result == 0) {
                return false;
            }
            var $a = $('<a />', {
                'class': 'list-group-item list-group-item-action',
                'href': '?category=' + data.id
            }).html(name);
            $a.appendTo('#categories_list');
            $('#' + modalId).modal('hide');
        },
        error: function () {

        }
    });
};

AdminCategories.prototype.editCategorySave = function (e) {
    var modalId = 'edit_category_modal';
    var name = $('#' + modalId + '_name').val();
    var id = $('#' + modalId).attr('data-id');
    if (!/.+/.test(name)) {
        $('#' + modalId + '_error_1').show();
        return false;
    }
    $.post({
        url: '/admin/ajaxEditCategory',
        data: {id: id, name: name},
        dataType: 'json',
        success: function (data) {
            if (data.result == 0) {
                return false;
            }
            $('.category_name[data-id=' + id + ']').text(name);
            $('#' + modalId).modal('hide');
        },
        error: function () {

        }
    });
};

AdminCategories.prototype.removeCategorySave = function (e) {
    var modalId = 'remove_category_modal';
    var id = $('#' + modalId).attr('data-id');
    $.post({
        url: '/admin/ajaxRemoveCategory',
        data: {id: id},
        dataType: 'json',
        success: function (data) {
            if (data.result == 0) {
                return false;
            }
            $('#' + modalId).modal('hide');
            window.location.reload(true);
        },
        error: function () {

        }
    });
};

AdminCategories.prototype.addSubCategorySave = function (e) {
    var modalId = 'add_sub_category_modal';
    var name = $('#' + modalId + '_name').val();
    var id = $('#' + modalId).attr('data-id');
    if (!/.+/.test(name)) {
        $('#' + modalId + '_error_1').show();
        return false;
    }
    $.post({
        url: '/admin/ajaxAddSubCategory',
        data: {id: id, name: name},
        dataType: 'json',
        success: function (data) {
            if (data.result == 0) {
                return false;
            }
            var $h1 = $('<h1 />', { 'class': 'display-4 border border-left-0 border-top-0 border-right-0' }).html('<i class="fa fa-angle-double-right" aria-hidden="true"></i>');
            var $span = $('<span />', { 'class': 'sub_category_name', 'data-id': data.id }).html(name);
            var $buttonView = $(' <button />', { 'class': 'btn btn-primary'}).html('View products');
            var $buttonEdit = $(' <button />', { 'class': 'btn btn-warning edit_sub_category', 'data-id': data.id }).html('Edit');
            var $buttonRemove = $('<button />', { 'class': 'btn btn-danger remove_sub_category', 'data-id': data.id }).html('Remove');
            $h1.append(' ').append($span).append(' ').append($buttonView).append(' ').append($buttonEdit).append(' ').append($buttonRemove);
            $h1.appendTo('#sub_categories_list');
            $('#' + modalId).modal('hide');
        },
        error: function () {

        }
    });
};

AdminCategories.prototype.editSubCategorySave = function (e) {
    var modalId = 'edit_sub_category_modal';
    var name = $('#' + modalId + '_name').val();
    var id = $('#' + modalId).attr('data-id');
    if (!/.+/.test(name)) {
        $('#' + modalId + '_error_1').show();
        return false;
    }
    $.post({
        url: '/admin/ajaxEditSubCategory',
        data: {id: id, name: name},
        dataType: 'json',
        success: function (data) {
            if (data.result == 0) {
                return false;
            }
            $('.sub_category_name[data-id=' + id + ']').text(name);
            $('#' + modalId).modal('hide');
        },
        error: function () {

        }
    });
};

AdminCategories.prototype.removeSubCategorySave = function (e) {
    var modalId = 'remove_sub_category_modal';
    var id = $('#' + modalId).attr('data-id');
    $.post({
        url: '/admin/ajaxRemoveSubCategory',
        data: {id: id},
        dataType: 'json',
        success: function (data) {
            if (data.result == 0) {
                return false;
            }
            $('.sub_category_name[data-id=' + id + ']').parent().remove();
            $('#' + modalId).modal('hide');
        },
        error: function () {

        }
    });
};


$(document).ready(function () {
    var adminCategories = new AdminCategories();

});