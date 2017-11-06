<?php

$uri = $_SERVER['REDIRECT_URL'];
$navigation = array(
    '/' =>  array( 'title' => 'Website', 'active' => false ),
    '/admin/categories' => array( 'title' => 'Categories', 'active' => false ),
    '/admin/products' => array( 'title' => 'Products', 'active' => false ),
    '/admin/users' =>  array( 'title' => 'Users', 'active' => false )
);
if (!empty($navigation[$uri])) {
    $navigation[$uri]['active'] = true;
}

function renderModalCategory ($id, $errorText1, $title) {
    ?>
    <div class="modal fade" id="<?=$id?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?=$title?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="<?=$id?>_error_1">
                        <?=$errorText1?>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="<?=$id?>_name">Name:</label>
                            <input type="text" class="form-control" id="<?=$id?>_name" placeholder="Name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="<?=$id?>_btn_save">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function renderModalRemoveCategory ($id, $title, $text) {
    ?>
    <div class="modal fade" id="<?=$id?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?=$title?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?=$text?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="<?=$id?>_btn_save">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function renderModalProduct ($id, $title) {
    ?>
    <div class="modal fade" id="<?=$id?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?=$title?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert" id="<?=$id?>_alert"></div>
                    <div class="form-group">
                        <label for="<?=$id?>_name">Title:</label>
                        <input type="text" class="form-control" id="<?=$id?>_name">
                    </div>
                    <div class="form-group">
                        <label for="<?=$id?>_description">Description:</label>
                        <textarea class="form-control" id="<?=$id?>_description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="<?=$id?>_category">Category:</label>
                        <select class="form-control" id="<?=$id?>_category"></select>
                    </div>
                    <div class="form-group">
                        <label for="<?=$id?>_sub_category">Sub category:</label>
                        <select class="form-control" id="<?=$id?>_sub_category"></select>
                    </div>
                    <label for="<?=$id?>_price">Price:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="<?=$id?>_price" aria-describedby="price-unit">
                        <span class="input-group-addon" id="price-unit">$</span>
                    </div>
                    <div class="form-group">
                        <label for="<?=$id?>_count">Count:</label>
                        <input type="text" class="form-control" id="<?=$id?>_count" value="1">
                    </div>
                    <label for="<?=$id?>_weight">Weight:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="<?=$id?>_weight" value="1" aria-describedby="weight-unit">
                        <span class="input-group-addon" id="weight-unit">g</span>
                    </div>
                    <div class="form-group">
                        <label for="<?=$id?>_size">Size:</label>
                        <input type="text" class="form-control" id="<?=$id?>_size" placeholder="Example: L, XL (...)">
                    </div>
                    <div class="form-group">
                        <label for="<?=$id?>_image">Image:</label>
                        <input type="file" class="form-control-file" id="<?=$id?>_image">
                    </div>
                    <label>Photo upload progress:</label>
                    <div class="progress">
                        <div class="progress-bar" id="<?=$id?>_image_upload_progress" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <br>
                    <img src="" id="<?=$id?>_image_view" class="img-thumbnail">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="<?=$id?>_btn_save">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/bootstrap-reboot.min.css?v=<?=APP_VERSION?>">
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/bootstrap-grid.min.css?v=<?=APP_VERSION?>">
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/bootstrap.min.css?v=<?=APP_VERSION?>">
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/font-awesome.min.css?v=<?=APP_VERSION?>">
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/<?=$this->params['cssname']?>.css?v=<?=APP_VERSION?>">
    <title>BRAND admin panel</title>
    <script src="<?= DIR_TO_PROD ?>/js/jquery-3.2.1.min.js?v=<?=APP_VERSION?>"></script>
    <script src="<?= DIR_TO_PROD ?>/js/popper.min.js?v=<?=APP_VERSION?>"></script>
    <script src="<?= DIR_TO_PROD ?>/js/bootstrap.bundle.min.js?v=<?=APP_VERSION?>"></script>
    <script src="<?= DIR_TO_PROD ?>/js/bootstrap.min.js?v=<?=APP_VERSION?>"></script>
    <script src="<?= DIR_TO_PROD ?>/js/<?=$this->params['jsname']?>.js?v=<?=APP_VERSION?>"></script>
</head>
<body>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Brand admin panel</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php foreach ($navigation as $href => $arr_nav) : ?>
                        <a class="nav-item nav-link <?=($arr_nav['active']?' active' : '')?>" href="<?=$href?>"><?=$arr_nav['title']?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </nav>
        <div class="content-main"></div>
    </div>

    <?=renderModalCategory('add_category_modal', 'The name can not be empty!', 'Add category')?>
    <?=renderModalCategory('edit_category_modal', 'The name can not be empty!', 'Edit category')?>
    <?=renderModalRemoveCategory('remove_category_modal', 'Remove category', 'Are you sure, want to delete category?')?>

    <?=renderModalCategory('add_sub_category_modal', 'The name can not be empty!', 'Add sub category')?>
    <?=renderModalCategory('edit_sub_category_modal', 'The name can not be empty!', 'Edit sub category')?>
    <?=renderModalRemoveCategory('remove_sub_category_modal', 'Remove sub category', 'Are you sure, want to delete sub category?')?>

    <?=renderModalProduct('add_product_modal', 'Add category')?>
    <?=renderModalProduct('edit_product_modal', 'Edit category')?>

</body>
</html>