<div class="catalog">
    <?php foreach ($this->params['catalog'] as $item) : ?>
    <div class="catalog__item">
        <h2 class="catalog_item_title"><?=$item['title']?></h2>
        <img src="<?=$item['img_src']?>" alt="<?=$item['img_alt']?>" class="catalog__item_img">
        <p class="catalog__item_description"><?=mb_strimwidth($item['description'], 0, 140)?> (...)</p>
        <h3 class="catalog__item_price">PRICE: <?=$item['price']?>$</h3>
        <button class="catalog__item_btn-buy">Add to cart</button>
        <a href="/catalog/detail?id=<?=$item['id']?>" class="catalog__item_btn-view-detail">View detail</a>
    </div>
    <?php endforeach; ?>
</div>