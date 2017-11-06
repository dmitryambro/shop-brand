<div class="row" id="categories">
    <div class="col-md-2 offset-md-1">
        <br>
        <button type="button" class="btn btn-primary add_category">Add category</button>
        <br>
        <br>
        <div class="list-group" id="categories_list">
            <?php foreach ($this->params['categories'] as $index => $category) : ?>
                <a href="?category=<?=$category['id']?>" class="list-group-item list-group-item-action<?=($index == $this->params['category_active_index'] ? ' active' : '')?>"><span class="category_name" data-id="<?=$category['id']?>"><?=$category['name']?></span></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-8" id="sub_categories_list">
        <?php if (count($this->params['categories'] > 0)) : ?>
        <?php
            $category_id = $this->params['categories'][$this->params['category_active_index']]['id'];
            $category_name = $this->params['categories'][$this->params['category_active_index']]['name'];
        ?>
            <h1 class="display-3 border border-left-0 border-top-0 border-right-0"><span class="category_name" data-id="<?=$category_id?>"><?=$category_name?></span> <button type="button" class="btn btn-primary add_sub_category" data-id="<?=$category_id?>">Add sub category</button> <button type="button" class="btn btn-warning edit_category" data-id="<?=$category_id?>">Edit</button> <button type="button" class="btn btn-danger remove_category" data-id="<?=$category_id?>">Remove</button></h1>
            <?php foreach ($this->params['sub_categories'] as $sub_category) : ?>
                <h1 class="display-4 border border-left-0 border-top-0 border-right-0"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span class="sub_category_name" data-id="<?=$sub_category['id']?>"><?=$sub_category['name']?></span> <button type="button" class="btn btn-primary">View products</button> <button type="button" class="btn btn-warning edit_sub_category" data-id="<?=$sub_category['id']?>">Edit</button> <button type="button" class="btn btn-danger remove_sub_category" data-id="<?=$sub_category['id']?>">Remove</button></h1>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>