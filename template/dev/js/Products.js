$(document).ready(function () {
    var cart = new Cart('header__shop-cart-count', '.products__product');
    var filterFormCategories = new FilterFormCategories('filter-category-container', 'filter-category-container-list', 'filter-sub-category-container', 'filter-sub-category-container-list');

    window.location.search.slice(1).split('&').map(function (get) {
        get = get.split('=');
        switch (get[0]) {
            case 'category_ids':
                filterFormCategories.setCategories(get[1].split(','));
                break;
            case 'sub_category_ids':
                filterFormCategories.setSubCategories(get[1].split(','));
                break;
        }
    });

    $('.products__filter_button').on('click', function () {
        var gets = [];
        var categoriesIds = filterFormCategories.categoriesSelect;
        var subCategoriesIds = filterFormCategories.subCategoriesSelect;
        var page = '1';
        var searchText = $('.filter-search-input').val();
        if (categoriesIds.length > 0) gets.push('category_ids=' + categoriesIds.join(','));
        if (subCategoriesIds.length > 0) gets.push('sub_category_ids=' + subCategoriesIds.join(','));
        if (searchText.length > 0) gets.push('search_text=' + searchText);
        gets.push('page=' + page);
        window.location.href = '/products/filter/?' + gets.join('&');
    });
});