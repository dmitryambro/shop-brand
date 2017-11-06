<div class="rose-panel">
    <div class="rose-panel__center center">
        <div class="rose-panel__left">
            <div class="rose-panel__title">Products</div>
        </div>
    </div>
</div>

<div class="products">
    <div class="products__center center">
        <header class="products__filter">
<!--            <div class="products__filter_text">filter:</div>-->
            <div class="products__filter_container">
                <label for="" class="products__filter_label">categories:</label>
                <div class="products__filter_select filter-category-container"></div>
                <div class="products__filter-form filter-category-container-list"></div>
            </div>
            <div class="products__filter_container">
                <label for="" class="products__filter_label">Sub categories:</label>
                <div class="products__filter_select filter-sub-category-container"></div>
                <div class="products__filter-form filter-sub-category-container-list"></div>
            </div>
            <div class="products__filter_container">
                <label for="" class="products__filter_label">Search text:</label>
                <input class="products__filter_input filter-search-input" placeholder="Search for Items..." value="<?=(isset($_GET['search_text']) ? $_GET['search_text'] : '')?>">
            </div>
            <button class="products__filter_button">filter</button>
        </header>
        <section class="products__container">
            <?php if (count($this->params['featured_products_list']) == 0) : ?>
                <h3>Result not found!</h3>
            <?php endif; ?>
            <?php foreach ($this->params['featured_products_list'] as $product) : ?>
                <article class="products__product product" data-id="<?=$product['id']?>" data-count="1" data-price="<?=$product['price']?>"><img src="<?=$product['image_url']?>" class="product__img">
                    <div class="product__title"><?=$product['name']?></div>
                    <div class="product__price">$<?=$product['price']?></div>
                </article>
            <?php endforeach; ?>
        </section>
        <footer class="products__footer">
            <?php for ($page = 1; $page <= $this->params['pages']; $page++) : ?>
                <a href="<?=$this->params['page_link']?><?=$page?>" class="products__button products__button_page"><?=$page?></a>
            <?php endfor; ?>
        </footer>
    </div>
</div>