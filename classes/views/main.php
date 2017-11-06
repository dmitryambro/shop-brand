<section class="big-slider">
    <div class="big-slider__center center">
        <div class="big-slider__img">
            <div class="big-slider__losung">
                <h1 class="big-slider__big-text">the brand</h1>
                <h3 class="big-slider__text">of luxurious
                    <div class="big-slider__text_rose">fashion</div>
                </h3>
            </div>
        </div>
    </div>
</section>

<div class="products">
    <div class="products__center center">
        <header class="products__header">
            <div class="products__big-text">Featured Items</div>
            <div class="products__text">Shop for items based on want we featured in this week</div>
        </header>
        <section class="products__container">
            <?php foreach ($this->params['featured_products_list'] as $product) : ?>
                <article class="products__product product" data-id="<?=$product['id']?>" data-count="1" data-price="<?=$product['price']?>"><img src="<?=$product['image_url']?>" class="product__img">
                    <div class="product__title"><?=$product['name']?></div>
                    <div class="product__price">$<?=$product['price']?></div>
                </article>
            <?php endforeach; ?>
        </section>
        <footer class="products__footer"><a href="/products" class="products__button">Browse All Product</a></footer>
    </div>
</div>