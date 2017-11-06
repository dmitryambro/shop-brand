function Categories (categoriesClass, callback) {
    var self = this;
    this.categoriesClass = categoriesClass;
    this.$categories = $('.' + this.categoriesClass);
    this.categories = [];
    this.selectCategories = {};
    $.get({
        url: '/admin/ajaxCategoriesAndSub',
        dataType: 'json',
        context: this,
        success: function (json) {
            if (json.result == 0) {
                return false;
            }
            this.categories = json.categories;
            this.renderCategories();
            callback.call(this);
        },
        error: function () {

        }
    });

    this.$categories
        .on('change', '[name=category]', function () { self.changeCategory($(this)); })
        .on('change', '[name=sub_category]', function () { self.changeSubCategory($(this)); });
}

Categories.prototype.changeCategory = function ($category) {
    var self = this;
    var $categoryContainer = $category.parent().parent().parent();
    var categoryId = $category.val();
    var categoryChecked = $category.get(0).checked;
    if (categoryChecked) {
        this.selectCategories[categoryId] = {};
        hash.setCategory(categoryId);
        if ($categoryContainer.find('.list_sub_category input[type=checkbox]:checked').length === 0) {
            $categoryContainer.find('.list_sub_category').each(function () {
                var $subCategory = $(this).find('input[type=checkbox]');
                $subCategory.get(0).checked = categoryChecked;
                hash.setSubCategory($subCategory.val());
            });
        }
    } else {
        hash.delCategory(categoryId);
        delete this.selectCategories[categoryId];
        $categoryContainer.find('.list_sub_category').each(function () {
            var $subCategory = $(this).find('input[type=checkbox]');
            $subCategory.get(0).checked = categoryChecked;
            hash.delSubCategory($subCategory.val());
        });
    }
    $(document).trigger('filter-change');
};

Categories.prototype.changeSubCategory = function ($subCategory) {
    var $categoryContainer = $subCategory.parent().parent().parent();
    var categoryId = $subCategory.attr('data-category-id');
    var subCategoryId = $subCategory.val();
    var subCategoryChecked = $subCategory.get(0).checked;
    if (this.selectCategories[categoryId] == null) {
        this.selectCategories[categoryId] = {};
        hash.setCategory(categoryId);
        $categoryContainer.find('.list_category input[type=checkbox]').get(0).checked = true;
    }
    if (subCategoryChecked) {
        this.selectCategories[categoryId][subCategoryId] = { checked: true };
        hash.setSubCategory(subCategoryId);
    } else {
        delete this.selectCategories[categoryId][subCategoryId];
        hash.delSubCategory(subCategoryId);
    }
    if ($categoryContainer.find('.list_sub_category input[type=checkbox]:checked').length === 0) {
        delete this.selectCategories[categoryId];
        hash.delCategory(categoryId);
        $categoryContainer.find('.list_category input[type=checkbox]').get(0).checked = false;
    }
    $(document).trigger('filter-change');
};

Categories.prototype.renderCategories = function () {
    this.$categories.empty();
    this.selectCategories = {};

    var hashCategories = hash.params.categories;
    var hashSubCategories = hash.params.sub_categories;
    for (var i = 0; i < hashCategories.length; i++) {
        var categoryId = hashCategories[i];
        if (this.categories[categoryId] != null) {
            this.selectCategories[categoryId] = {};
            this.categories[categoryId].selected = true;
            for (var j = 0; j < hashSubCategories.length; j++) {
                var subCategoryId = hashSubCategories[j];
                if (this.categories[categoryId].sub_categories != null) {
                    for (var n = 0; n < this.categories[categoryId].sub_categories.length; n++) {
                        if (this.categories[categoryId].sub_categories[n].id == subCategoryId) {
                            this.selectCategories[categoryId][subCategoryId] = { checked: true };
                            this.categories[categoryId].sub_categories[n].selected = true;
                        }
                    }
                }
            }
        }
    }

    var categoriesKeys = Object.keys(this.categories);
    for (var i = 0; i < categoriesKeys.length; i++) {
        var id = categoriesKeys[i];
        this.$categories.append(this.renderCategory(this.categories[id]));
    }
};

Categories.prototype.renderCategory = function (category) {
    var $category = $('<div />', { 'class': 'categories-list__category', 'data-id': category.id });
    var $div = $('<div />');
    var $label = $('<label />', { 'class': 'list_category custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-2' });
    var $checkBox = $('<input />', { 'class': 'custom-control-input', 'type': 'checkbox', 'value': category.id, 'name': 'category' });
    var $span = $('<span />', { 'class': 'custom-control-indicator' });
    var $text = $('<b />', { 'class': 'custom-control-description' }).html(category.name);
    if (category.selected) $checkBox.get(0).checked = true;
    $label.append($checkBox).append($span).append($text);
    $div.append($label);
    $category.append($div);
    for (var i = 0; i < category.sub_categories.length; i++) {
        $category.append(this.renderSubCategory(category.sub_categories[i]));
    }
    return $category;
};

Categories.prototype.renderSubCategory = function (subCategory) {
    var $div = $('<div />');
    var $label = $('<label />', { 'class': 'list_sub_category custom-control custom-checkbox mb-2 offset-1 mr-sm-2 mb-sm-2' });
    var $checkBox = $('<input />', { 'class': 'custom-control-input', 'type': 'checkbox', 'value': subCategory.id, 'name': 'sub_category', 'data-category-id': subCategory.category_id });
    var $span = $('<span />', { 'class': 'custom-control-indicator' });
    var $text = $('<span />', { 'class': 'custom-control-description' }).html(subCategory.name);
    if (subCategory.selected) $checkBox.get(0).checked = true;
    $label.append($checkBox).append($span).append($text);
    $div.append($label);
    return $div;
};

function Hash () {
    this.params = {
        categories: [],
        sub_categories: [],
        page: '1'
    };
    this.explain();
}

Hash.prototype.setCategory = function (category) {
    var categories = this.params.categories;
    for (var i = 0; i < categories.length; i++) {
        if (categories[i] == category) return false;
    }
    this.params.categories.push(category);
    this.changeHash();
};

Hash.prototype.delCategory = function (category) {
    this.params.categories = this.params.categories.filter( function (c) {
        return c != category;
    });
    this.changeHash()
};

Hash.prototype.setSubCategory = function (subCategory) {
    var subCategories = this.params.sub_categories;
    for (var i = 0; i < subCategories.length; i++) {
        if (subCategories[i] == subCategory) return false;
    }
    this.params.sub_categories.push(subCategory);
    this.changeHash();
};

Hash.prototype.delSubCategory = function (subCategory) {
    this.params.sub_categories = this.params.sub_categories.filter( function (c) {
        return c != subCategory;
    });
    this.changeHash()
};

Hash.prototype.explain = function () {
    var hash = window.location.hash.slice(1).split('&').map(function (a) { return a.split('='); });
    for (var i = 0; i < hash.length; i++) {
        var _hash = hash[i];
        if (_hash.length === 2) {
            if (this.params[_hash[0]]) {
                switch (_hash[0]) {
                    case 'categories':
                    case 'sub_categories':
                        if (/.+/.test(_hash[1])) this.params[_hash[0]] = _hash[1].split(',');
                        break;
                    default:
                        this.params[_hash[0]] = _hash[1];
                }
            }
        }
    }
};

Hash.prototype.changeHash = function () {
    var hash = [];
    this.params.categories = this.params.categories.filter( function (category) { return /.+/.test(category); });
    this.params.sub_categories = this.params.sub_categories.filter( function (subCategory) { return /.+/.test(subCategory); });
    if (this.params.categories.length > 0) hash.push(['categories', this.params.categories.join(',')].join('='));
    if (this.params.sub_categories.length > 0) hash.push(['sub_categories', this.params.sub_categories.join(',')].join('='));
    hash.push(['page', this.params.page].join('='));
    window.location.hash = '#' + hash.join('&');
};

function ModalProduct (modalId, classButtonOpen, categories) {
    var self = this;
    this.modalId = modalId;
    this.classButtonOpen = classButtonOpen;
    this.categories = categories;

    this.$alert = $('#' + this.modalId + '_alert');
    this.$name = $('#' + this.modalId + '_name');
    this.$description = $('#' + this.modalId + '_description');
    this.$category = $('#' + this.modalId + '_category');
    this.$subCategory = $('#' + this.modalId + '_sub_category');
    this.$price = $('#' + this.modalId + '_price');
    this.$count = $('#' + this.modalId + '_count');
    this.$weight = $('#' + this.modalId + '_weight');
    this.$size = $('#' + this.modalId + '_size');
    this.$image = $('#' + this.modalId + '_image');
    this.$imageView = $('#' + this.modalId + '_image_view');
    this.$imageUploadProgress = $('#' + this.modalId + '_image_upload_progress');
    this.defaults = { name: '', description: '', categoryId: '', price: '', count: 1, weight: 1, size: '' };

    var categoriesIds = Object.keys(this.categories.categories);
    if (categoriesIds.length === 0) {
        return false;
    }
    if (this.categories.categories[categoriesIds[0]].sub_categories.length === 0) {
        return false;
    }

    this.renderCategoryOptions();
    this.defaults.categoryId = categoriesIds[0];
    this.$category.on('change', function () { self.renderSubCategoryOptions($(this).val()) });
    $(document).on('click', '.' + this.classButtonOpen, function (e) { self.open(e); });
    $('#' + this.modalId + '_btn_save').on('click', function () { self.save(); });
    this.$image.on('change', function () { self.uploadImage(); });
}

ModalProduct.prototype.uploadImage = function () {
    var self = this;
    this.$imageView.hide();
    var data = new FormData();
    data.append('file', this.$image.get(0).files[0]);
    var imageName = this.$image.val();
    var imageSize = this.$image.get(0).files[0].size;
    var imageExt = imageName.substr((imageName.lastIndexOf('.') + 1)).toLowerCase();
    switch (imageExt) {
        case 'jpg': case 'jpeg': case 'png': case 'gif':
            if (imageSize < 1000000) {
                $.post({
                    url: '/admin/ajaxUploadImage',
                    data: data,
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    context: this,
                    dataType: 'json',
                    xhr: function () {
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function( e) {
                                var percent = 0;
                                var position = e.loaded || e.position;
                                var total = e.total;
                                if (e.lengthComputable) {
                                    percent = Math.ceil(position / total * 100);
                                }
                                self.$imageUploadProgress.css('width', percent + '%').attr('aria-valuenow', percent).html(percent + '%');
                            }, true);
                        }
                        return xhr;
                    },
                    success: function (json) {
                        if (json.result == 0) {
                            console.log(json.message);
                            return false;
                        }
                        console.log(json);
                        this.$imageView.attr('src', json.path).show();
                    },
                    error: function () {}
                });
            }
            break;
    }
};

ModalProduct.prototype.renderCategoryOptions = function () {
    this.$category.empty();
    var categoriesIds = Object.keys(this.categories.categories);
    for (var i = 0; i < categoriesIds.length; i++) {
        var categoryId = categoriesIds[i];
        var $option = $('<option />', { 'value': categoryId }).html(this.categories.categories[categoryId].name);
        this.$category.append($option);
    }
};

ModalProduct.prototype.renderSubCategoryOptions = function (categoryId) {
    var subCategories = this.categories.categories[categoryId].sub_categories;
    this.$subCategory.empty();
    for (var i = 0; i < subCategories.length; i++) {
        var $option = $('<option />', { 'value': subCategories[i].id }).html(subCategories[i].name);
        this.$subCategory.append($option);
    }
};

ModalProduct.prototype.getDataForm = function () {
    return {
        name: this.$name.val(),
        description: this.$description.val(),
        category: this.$category.val(),
        subCategory: this.$subCategory.val(),
        price: this.$price.val(),
        count: this.$count.val(),
        weight: this.$weight.val(),
        size: this.$size.val(),
        image_url: this.$imageView.attr('src')
    };
};

ModalProduct.prototype.check = function () {
    var formData = this.getDataForm();
    var formResult = {
        result: true,
        message: ''
    };
    if (!/.+/.test(formData.name)) formResult = { result: false, message: 'name' };
    else if (!/.+/.test(formData.description)) formResult = { result: false, message: 'description' };
    else if (!/^[0-9]+?(\.|,)?[0-9]+$/.test(formData.price)) formResult = { result: false, message: 'price' };
    else if (!/^[0-9]+$/.test(formData.count)) formResult = { result: false, message: 'Count must by a number' };
    else if (!/^[0-9]+?(\.|,)?[0-9]+$/.test(formData.weight)) formResult = { result: false, message: 'weight' };
    else if (!/.+/.test(formData.size)) formResult = { result: false, message: 'size' };
    else if (!/.+/.test(formData.src)) formResult = { result: false, message: 'image' };
    if (formResult.result) {
        this.$alert.hide().html('');
        return true;
    }
    this.$alert.show().html(formResult.message);
    $('#' + this.modalId).scrollTop(0);
    return false;
};

function ModalProductAdd (modalId, classButtonOpen, categories) {
    ModalProduct.call(this, modalId, classButtonOpen, categories);
}

ModalProductAdd.prototype = Object.create(ModalProduct.prototype);
ModalProductAdd.prototype.constructor = ModalProductAdd;

ModalProductAdd.prototype.open = function () {
    this.$alert.hide().html('');
    this.$name.val(this.defaults.name);
    this.$description.val(this.defaults.description);
    this.$category.val(this.defaults.categoryId);
    this.renderSubCategoryOptions(this.defaults.categoryId);
    this.$price.val(this.defaults.price);
    this.$count.val(this.defaults.count);
    this.$weight.val(this.defaults.weight);
    this.$size.val(this.defaults.size);
    $('#' + this.modalId).modal('show');
};

ModalProductAdd.prototype.save = function () {
    if (this.check()) {
        $.post({
            url: '/admin/ajaxAddProduct',
            data: this.getDataForm(),
            dataType: 'json',
            context: this,
            success: function (json) {

            },
            error: function (err) {}
        });
    }
};

function ModalProductEdit (modalId, classButtonOpen, categories) {
    ModalProduct.call(this, modalId, classButtonOpen, categories);
    this.editNowId = null;
}

ModalProductEdit.prototype = Object.create(ModalProduct.prototype);
ModalProductEdit.prototype.constructor = ModalProductEdit;

ModalProductEdit.prototype.open = function (e) {
    this.$alert.hide().html('');
    var id = $(e.target).attr('data-id');
    this.editNowId = id;
    $.get({
        url: '/admin/ajaxGetProduct',
        data: { id: id },
        dataType: 'json',
        context: this,
        success: function (json) {
            if (json.result == 0) {
                console.log(json.message);
                return false;
            }
            this.$name.val(json.product.name);
            this.$description.val(json.product.description);
            this.$category.val(json.product.category_id);
            this.renderSubCategoryOptions(json.product.category_id);
            this.$subCategory.val(json.product.sub_category_id);
            this.$price.val(json.product.price);
            this.$count.val(json.product.count);
            this.$weight.val(json.product.price);
            this.$size.val(json.product.size);
            this.$imageView.attr('src', json.product.image_url);
        }
    });
    $('#' + this.modalId).modal('show');
};

ModalProductEdit.prototype.save = function () {
    if (this.check()) {
        var data = this.getDataForm();
        data['id'] = this.editNowId;
        $.post({
            url: '/admin/ajaxEditProduct',
            data: data,
            dataType: 'json',
            context: this,
            success: function (json) {

            },
            error: function (err) {}
        });
    }
};

function Products (classProductsContainer, classButtonEdit, classButtonRemove, categories) {
    var self = this;
    this.classProductsContainer = classProductsContainer;
    this.classButtonEdit = classButtonEdit;
    this.classButtonRemove = classButtonRemove;
    this.categories = categories;
    this.$container = $('.' + this.classProductsContainer);
    this.renderPage();
    $(document).on('filter-change', function () {
        hash.params.page = '1';
        hash.changeHash();
        self.renderPage();
    });
}

Products.prototype.getAjaxPage = function (page, categoriesIds, subCategoriesIds, callback) {
    $.get({
        url: '/admin/ajaxGetProducts',
        data: {
            page: page,
            categories_ids: categoriesIds,
            sub_categories_ids: subCategoriesIds
        },
        dataType: 'json',
        context: this,
        success: function (json) {
            if (json.result == 0) {
                console.log(json.message);
                return false;
            }
            callback.call(this, json.products);
        },
        error: function () {}
    })
};

Products.prototype.renderPage = function () {
    var page = hash.params.page;
    var categoriesIds = null;
    var subCategoriesIds = null;
    if (Object.keys(this.categories.selectCategories).length > 0) {
        categoriesIds = Object.keys(this.categories.selectCategories);
        subCategoriesIds = [];
        for (var i = 0; i < categoriesIds.length; i++) {
            subCategoriesIds = subCategoriesIds.concat(Object.keys(this.categories.selectCategories[categoriesIds[i]]));
        }
        categoriesIds = categoriesIds.join(',');
        subCategoriesIds = subCategoriesIds.join(',');
    }
    this.$container.empty();
    this.getAjaxPage(page, categoriesIds, subCategoriesIds, function (products) {
        for (var i = 0; i < products.length; i++) {
            this.$container.append(this.renderProduct(products[i]));
        }
    });
};

Products.prototype.renderProduct = function (product) {
    var $product = $('<div />', { 'class': 'col-md-4 mb-2 admin-product', 'data-id': product.id });
    var $card = $('<div />', { 'class': 'card' });
    var $cardImg = $('<img />', { 'class': 'card-img-top', 'src': product.image_url, 'alt': product.name });
    var $cardBody = $('<div />', { 'class': 'card-body admin-product__body' });
    var $cardBodyH4 = $('<h4 />', { 'class': 'card-title' }).html(product.name);
    var $cardBodyH6 = $('<h6 />', { 'class': 'card-subtitle mb-2 text-muted' }).html('test/test');
    var $cardBodyP = $('<p />', { 'class': 'admin-product__p' }).html(product.description);
    var $cardBodyUl = $('<ul />', { 'class': 'list-group list-group-flush' });
    var $cardBodyUlPrice = $('<li />', { 'class': 'list-group-item' }).html('<b>Price: </b> <span>' + product.price + '$</span>');
    var $cardBodyUlCount = $('<li />', { 'class': 'list-group-item' }).html('<b>Count: </b> <span>' + product.count + '</span>');
    var $cardBody2 = $('<div />', { 'class': 'card-body' });
    var $cardBody2ButtonEdit = $('<button />', { 'class': 'btn btn-primary admin_edit_product', 'data-id': product.id }).html('Edit');
    var $cardBody2ButtonRemove = $('<button />', { 'class': 'btn btn-danger admin_remove_product', 'data-id': product.id }).html('Remove');
    $cardBodyUl.append($cardBodyUlPrice).append($cardBodyUlCount);
    $cardBody.append($cardBodyH4).append($cardBodyH6).append($cardBodyP).append($cardBodyUl);
    $cardBody2.append($cardBody2ButtonEdit).append(' ').append($cardBody2ButtonRemove);
    $card.append($cardImg).append($cardBody).append($cardBody2);
    return $product.append($card);
};

$(document).ready(function () {
    window.hash = new Hash();

    new Categories('categories-list', function () {
        new Products('products-container', 'admin_edit_product', 'admin_remove_product', this);
        new ModalProductAdd('add_product_modal', 'add_product', this);
        new ModalProductEdit('edit_product_modal', 'admin_edit_product', this);
    });
});
