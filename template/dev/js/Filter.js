function FilterFormCategories (classContainerCategories, classContainerCategoriesList, classSubContainerCategories, classSubContainerCategoriesList) {
    var self = this;
    this.classContainerCategories = classContainerCategories;
    this.classContainerCategoriesList = classContainerCategoriesList;
    this.classSubContainerCategories = classSubContainerCategories;
    this.classSubContainerCategoriesList = classSubContainerCategoriesList;
    this.$containerCategories = $('.' + this.classContainerCategories);
    this.$containerCategoriesList = $('.' + this.classContainerCategoriesList);
    this.$containerSubCategories = $('.' + this.classSubContainerCategories);
    this.$containerSubCategoriesList = $('.' + this.classSubContainerCategoriesList);
    this.categoriesSelect = [];
    this.categoriesSelectNames = [];
    this.subCategoriesSelect = [];
    this.subCategoriesSelectNames = [];

    this.$containerCategoriesList.on('change', '.' + this.classContainerCategoriesList + '-checkbox', function () {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        if (this.checked) {
            var isIn = false;
            self.categoriesSelect.forEach( function (_id) { if (id == _id) isIn = true; });
            if (!isIn) {
                self.categoriesSelect.push(id);
                self.categoriesSelectNames.push(name);
            }
        } else {
            self.categoriesSelect = self.categoriesSelect.filter(function (i) { return i != id; });
            self.categoriesSelectNames = self.categoriesSelectNames.filter(function (i) { return i != name; });
        }
        self.subCategoriesSelect = [];
        self.subCategoriesSelectNames = [];
        self.renderSubCategories();
        self.writeSelectCategories();
    });

    this.$containerSubCategoriesList.on('change', '.' + this.classSubContainerCategoriesList + '-checkbox', function () {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        if (this.checked) {
            var isIn = false;
            self.subCategoriesSelect.forEach( function (_id) { if (id == _id) isIn = true; });
            if (!isIn) {
                self.subCategoriesSelect.push(id);
                self.subCategoriesSelectNames.push(name);
            }
        } else {
            self.subCategoriesSelect = self.subCategoriesSelect.filter(function (i) { return i != id; });
            self.subCategoriesSelectNames = self.subCategoriesSelectNames.filter(function (i) { return i != name; });
        }
        self.writeSelectSubCategories();
    });

    this.renderCategories();
    this.renderSubCategories();
}

FilterFormCategories.prototype.renderCategories = function () {
    var categories = CATEGORIES_LIST;
    var categoriesIds = Object.keys(categories);
    this.$containerCategories.empty();
    this.$containerCategoriesList.empty();
    for (var i = 0; i < categoriesIds.length; i++) {
        var category = categories[categoriesIds[i]];
        this.$containerCategoriesList.append(this.renderCategory(category));
    }
    this.writeSelectCategories();
};

FilterFormCategories.prototype.renderCategory = function (category) {
    var $div = $('<div />', { 'class': 'form__checkbox-container' });
    var $input = $('<input />', { 'type': 'checkbox', 'data-id': category.id, 'data-name': category.name, 'id': 'checkbox-category-' + category.id, 'class': 'form__checkbox-input ' + this.classContainerCategoriesList + '-checkbox' });
    var $label = $('<label />', { 'for': 'checkbox-category-' + category.id, 'class': 'form__checkbox-label' });
    var $figure = $('<div />', { 'class': 'form__checkbox-figure' });
    $label.append($figure).append(category.name);
    return $div.append($input).append($label);
};

FilterFormCategories.prototype.writeSelectCategories = function () {
    if (this.categoriesSelectNames.length > 0) {
        this.$containerCategories.html(this.categoriesSelectNames.join(', '));
    } else {
        this.$containerCategories.html(' - any - ');
    }
};

FilterFormCategories.prototype.setCategories = function (getCategoriesIds) {
    for (var i = 0; i < getCategoriesIds.length; i++) {
        var $categoryCheckBox = $('#checkbox-category-' + getCategoriesIds[i]);
        if ($categoryCheckBox.length > 0) {
            $categoryCheckBox.get(0).checked = true;
            $categoryCheckBox.change();
        }
    }
};

FilterFormCategories.prototype.renderSubCategories = function () {
    var categories = CATEGORIES_LIST;
    this.$containerSubCategories.empty();
    this.$containerSubCategoriesList.empty();
    for (var i = 0; i < this.categoriesSelect.length; i++) {
        var category = categories[this.categoriesSelect[i]];
        var $header = $('<div />', { 'class': 'products__filter-form-header' }).html(category.name);
        this.$containerSubCategoriesList.append($header);
        for (var j = 0; j < category.subs.length; j++) {
            var subCategory = category.subs[j];
            this.$containerSubCategoriesList.append(this.renderSubCategory(subCategory));
        }
    }
    this.writeSelectSubCategories();
};

FilterFormCategories.prototype.renderSubCategory = function (subCategory) {
    var $div = $('<div />', { 'class': 'form__checkbox-container' });
    var $input = $('<input />', { 'type': 'checkbox', 'data-id': subCategory.id, 'data-name': subCategory.name, 'id': 'checkbox-sub-category-' + subCategory.id, 'class': 'form__checkbox-input ' + this.classSubContainerCategoriesList + '-checkbox' });
    var $label = $('<label />', { 'for': 'checkbox-sub-category-' + subCategory.id, 'class': 'form__checkbox-label' });
    var $figure = $('<div />', { 'class': 'form__checkbox-figure' });
    $label.append($figure).append(subCategory.name);
    return $div.append($input).append($label);
};

FilterFormCategories.prototype.writeSelectSubCategories = function () {
    if (this.subCategoriesSelectNames.length > 0) {
        this.$containerSubCategories.html(this.subCategoriesSelectNames.join(', '));
    } else {
        this.$containerSubCategories.html(' - any - ');
    }
};

FilterFormCategories.prototype.setSubCategories = function (getSubCategoriesIds) {
    for (var i = 0; i < getSubCategoriesIds.length; i++) {
        var $subCategoryCheckBox = $('#checkbox-sub-category-' + getSubCategoriesIds[i]);
        if ($subCategoryCheckBox.length > 0) {
            $subCategoryCheckBox.get(0).checked = true;
            $subCategoryCheckBox.change();
        }
    }
};