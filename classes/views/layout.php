<!DOCTYPE html>
<html lang="en">
<head>
    <title>BRAND</title>
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/style.css?v=<?= APP_VERSION ?>">
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/header.css?v=<?= APP_VERSION ?>">
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/nav.css?v=<?= APP_VERSION ?>">
    <?php if (is_array($this->params['cssname'])) : ?>
        <?php foreach ($this->params['cssname'] as $cssName) : ?>
            <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/<?= $cssName ?>.css?v=<?= APP_VERSION ?>">
        <?php endforeach; ?>
    <?php else : ?>
        <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/<?= $this->params['cssname'] ?>.css?v=<?= APP_VERSION ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/footer.css?v=<?= APP_VERSION ?>">
    <script>
        var CATEGORIES_LIST = <?=json_encode($this->params['categories_list'])?>;
    </script>
    <script src="<?= DIR_TO_PROD ?>/js/jquery-3.2.1.min.js?v=<?= APP_VERSION ?>"></script>
    <?php if (is_array($this->params['jsname'])) : ?>
        <?php foreach ($this->params['jsname'] as $jsName) : ?>
        <script src="<?= DIR_TO_PROD ?>/js/<?= $jsName ?>.js?v=<?= APP_VERSION ?>"></script>
    <?php endforeach; ?>
    <?php else : ?>
        <script src="<?= DIR_TO_PROD ?>/js/<?= $this->params['jsname'] ?>.js?v=<?= APP_VERSION ?>"></script>
    <?php endif; ?>

<body>
<div class="container">
    <header class="header">
        <div class="header__center center"><a href="/" class="header__logo logo"></a>
            <form action="/products/filter" class="header__search-container">
<!--                <button class="header__button header__button_browse">Browse</button>-->
                <div class="header__drop-down-container">
                    <h3 class="header__drop-down-title">women</h3>
                    <ul class="header__drop-down-ulist">
                        <li class="header__drop-down-list">Dresses</li>
                    </ul>
                </div>
                <input placeholder="Search for Item..." name="search_text" class="header__input">
                <button class="header__button header__button_search"></button>
            </form>
            <div class="header__acc-container">
                <a href="/cart/" class="header__shop-cart">
                    <div class="header__shop-cart-count"></div>
                </a>
                <?php if ($this->params['islogin']) : ?>
                    <button class="header__button-acc">My Account
                        <div class="header__button-acc-dropdown">
                            <ul class="header__button-acc-dropdown-ul">
                                <li class="header__button-acc-dropdown-li"><?= $this->params['user_data']['first_name'] ?> <?= $this->params['user_data']['last_name'] ?></li>
                                <?php if ($this->params['user_data']['permission_id'] == 3) : ?>
                                    <li class="header__button-acc-dropdown-li"><a
                                                class="header__button-acc-dropdown-link" href="/admin">Admin panel</a>
                                    </li>
                                <?php endif; ?>
                                <li class="header__button-acc-dropdown-li"><a class="header__button-acc-dropdown-link"
                                                                              href="/orders">Orders</a></li>
                                <li class="header__button-acc-dropdown-li"><a class="header__button-acc-dropdown-link"
                                                                              href="/login/out">Logout</a></li>
                            </ul>
                        </div>
                    </button>

                <?php else : ?>
                    <a href="/login" class="header__button-login">Login</a>
                    <div class="header__button-line-text">OR</div>
                    <a href="/register" class="header__button-register">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <nav class="nav__center center">
        <ul class="nav__ulist">
            <li class="nav__list"><a href="/" class="nav__link">home</a></li>
            <?php foreach ($this->params['categories_list'] as $category) : ?>
                <li class="nav__list nav__list_drop"><a href="<?= $category['href'] ?>"
                                                        class="nav__link"><?= $category['name'] ?></a>
                    <div class="nav__drop-conainer">
                        <div class="nav__drop-cell">
                            <h3 class="nav__title"><?= $category['name'] ?></h3>
                            <ul class="nav__c-ulist">
                                <?php foreach ($category['subs'] as $sub_category) : ?>
                                    <li class="nav__c-list"><a href="<?= $sub_category['href'] ?>"
                                                               class="nav__c-link"><?= $sub_category['name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
            <li class="nav__list"><a href="/shop/hotDeals" class="nav__link">hot deals</a></li>
            <li class="nav__list"><a href="/contacts" class="nav__link">contacts</a></li>
        </ul>
    </nav>
    <main>
        <div class="content-main"></div>
    </main>
    <footer>
        <div class="footer">
            <div class="footer__center center">
                <div class="footer__copyrights">&copy;2017 Brand All Rights Reserved</div>
                <div class="footer__socials"><a href="#" class="footer__link footer__link_fb"></a><a href="#"
                                                                                                     class="footer__link footer__link_tw"></a><a
                            href="#" class="footer__link footer__link_in"></a><a href="#"
                                                                                 class="footer__link footer__link_pr"></a><a
                            href="#" class="footer__link footer__link_gp"></a></div>
            </div>
        </div>
    </footer>
</div>
</body>
</head>
</html>