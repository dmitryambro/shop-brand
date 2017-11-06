<!DOCTYPE html>
<html lang="en">
<head>
    <title>BRAND</title>
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/style.css?v=<?=APP_VERSION?>">
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/header.css?v=<?=APP_VERSION?>">
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/nav.css?v=<?=APP_VERSION?>">
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/<?=$this->params['cssname']?>.css?v=<?=APP_VERSION?>">
    <link rel="stylesheet" href="<?= DIR_TO_PROD ?>/css/footer.css?v=<?=APP_VERSION?>">
<body>
<div class="container">
    <header class="header">
        <div class="header__center center"><a href="./index.html" class="header__logo logo"></a>
            <div class="header__search-container">
                <button class="header__button header__button_browse">Browse</button>
                <div class="header__drop-down-conainer">
                    <h3 class="header__drop-down-title">women</h3>
                    <ul class="header__drop-down-ulist">
                        <li class="header__drop-down-list">Dresses</li>
                        <li class="header__drop-down-list">Tops</li>
                        <li class="header__drop-down-list">Sweaters/Knits</li>
                        <li class="header__drop-down-list">Jackets/Coats</li>
                        <li class="header__drop-down-list">Blazers</li>
                        <li class="header__drop-down-list">Denim</li>
                        <li class="header__drop-down-list">Leggings/Pants</li>
                        <li class="header__drop-down-list">Shirts/Shorts</li>
                        <li class="header__drop-down-list">Accessories</li>
                    </ul>
                    <h3 class="header__drop-down-title">men</h3>
                    <ul class="header__drop-down-ulist">
                        <li class="header__drop-down-list">Tees/Tank tops</li>
                        <li class="header__drop-down-list">Shirt/Polos</li>
                        <li class="header__drop-down-list">Sweaters</li>
                        <li class="header__drop-down-list">Sweatshirts/Hoodies</li>
                        <li class="header__drop-down-list">Blazes</li>
                        <li class="header__drop-down-list">Jackets/Vests</li>
                    </ul>
                </div>
                <input placeholder="Search for Item..." class="header__input">
                <button class="header__button header__button_search"></button>
            </div>
            <div class="header__acc-container">
                <a href="/" class="header__shop-cart"></a>
                <!--.header__drop-down-conainer//.header__shop-cart-count 2
                -->
                <button class="header__button-acc">My Account</button>
            </div>
        </div>
    </header>
    <nav class="nav__center center">
        <ul class="nav__ulist">
            <li class="nav__list"><a href="./index.html" class="nav__link">home</a>
                <div class="nav__drop-conainer">
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Blazers</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Denim</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Leggings/Pants</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Skirts/Shorts</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Accessories</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <div class="nav__cimg"><img src="./img/super-save.jpg" class="nav__img"></div>
                    </div>
                </div>
            </li>
            <li class="nav__list"><a href="#" class="nav__link">man</a>
                <div class="nav__drop-conainer">
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Blazers</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Denim</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Leggings/Pants</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Skirts/Shorts</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Accessories</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <div class="nav__cimg"><img src="./img/super-save.jpg" class="nav__img"></div>
                    </div>
                </div>
            </li>
            <li class="nav__list"><a href="#" class="nav__link nav__link_active">women</a>
                <div class="nav__drop-conainer">
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Blazers</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Denim</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Leggings/Pants</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Skirts/Shorts</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Accessories</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <div class="nav__cimg"><img src="./img/super-save.jpg" class="nav__img"></div>
                    </div>
                </div>
            </li>
            <li class="nav__list"><a href="#" class="nav__link">kids</a>
                <div class="nav__drop-conainer">
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Blazers</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Denim</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Leggings/Pants</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Skirts/Shorts</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Accessories</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <div class="nav__cimg"><img src="./img/super-save.jpg" class="nav__img"></div>
                    </div>
                </div>
            </li>
            <li class="nav__list"><a href="#" class="nav__link">accoseriese</a>
                <div class="nav__drop-conainer">
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Blazers</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Denim</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Leggings/Pants</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Skirts/Shorts</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Accessories</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <div class="nav__cimg"><img src="./img/super-save.jpg" class="nav__img"></div>
                    </div>
                </div>
            </li>
            <li class="nav__list"><a href="#" class="nav__link">featured</a>
                <div class="nav__drop-conainer">
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Blazers</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Denim</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Leggings/Pants</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Skirts/Shorts</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Accessories</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <div class="nav__cimg"><img src="./img/super-save.jpg" class="nav__img"></div>
                    </div>
                </div>
            </li>
            <li class="nav__list"><a href="#" class="nav__link">hot deals</a>
                <div class="nav__drop-conainer">
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Blazers</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Denim</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Leggings/Pants</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Skirts/Shorts</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Accessories</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                        </ul>
                    </div>
                    <div class="nav__drop-cell">
                        <h3 class="nav__title">women</h3>
                        <ul class="nav__c-ulist">
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Dresses</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Tops</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Sweaters/Knits</a></li>
                            <li class="nav__c-list"><a href="#" class="nav__c-link">Jackets/Coats</a></li>
                        </ul>
                        <div class="nav__cimg"><img src="./img/super-save.jpg" class="nav__img"></div>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <main>
        <div class="content-main"></div>
    </main>
    <footer>
        <section class="subscribe">
            <div class="subscribe__center center">
                <div class="subscribe__left">
                    <article id="option_1" class="opinion"><img src="./img/girl_img.png" class="opinion__img">
                        <p class="opinion__content">“Vestibulum quis porttitor dui! Quisque viverra nunc mi, a pulvinar
                            purus condimentua. Aliquam condimentum mattis neque sed pretium”</p>
                    </article>
                    <div class="opinion__buttons">
                        <div class="opinion__button"></div>
                        <div class="opinion__button opinion__button_select"></div>
                        <div class="opinion__button"></div>
                    </div>
                </div>
                <div class="subscribe__right">
                    <h3 class="subscribe__title">subscribe</h3>
                    <h5 class="subscribe__info">for our newsletter and promotion</h5>
                    <form class="subscribe__form">
                        <input placeholder="Enter Your Email" class="subscribe__input">
                        <button class="subscribe__button">Subscribe</button>
                    </form>
                </div>
            </div>
        </section>
        <div class="information__center center">
            <div class="information__cell">
                <div class="information__logo logo"></div>
                <p class="information__text">Objectively transition extensive data rather than cross functional
                    solutions. Monotonectally syndicate multidisciplinary materials before go forward benefits.
                    Intrinsicly syndicate an expanded array of processes and cross-unit partnerships. <br><br>Efficiently
                    plagiarize 24/365 action items and focused infomediaries.<br>Distinctively seize superior
                    initiatives for wireless technologies. Dynamically optimize.</p>
            </div>
            <div class="information__cell">
                <div class="information__title">company</div>
                <ul class="information__ulist">
                    <li class="information__list"><a href="" class="information__link">Home</a></li>
                    <li class="information__list"><a href="" class="information__link">Shop</a></li>
                    <li class="information__list"><a href="" class="information__link">About</a></li>
                    <li class="information__list"><a href="" class="information__link">How It Works</a></li>
                    <li class="information__list"><a href="" class="information__link">Contact</a></li>
                </ul>
            </div>
            <div class="information__cell">
                <div class="information__title">information</div>
                <ul class="information__ulist">
                    <li class="information__list"><a href="" class="information__link">Tearns & Condition</a></li>
                    <li class="information__list"><a href="" class="information__link">Privacy Policy</a></li>
                    <li class="information__list"><a href="" class="information__link">How to Buy</a></li>
                    <li class="information__list"><a href="" class="information__link">How to Sell</a></li>
                    <li class="information__list"><a href="" class="information__link">Promotion</a></li>
                </ul>
            </div>
            <div class="information__cell">
                <div class="information__title">hop category</div>
                <ul class="information__ulist">
                    <li class="information__list"><a href="" class="information__link">Men</a></li>
                    <li class="information__list"><a href="" class="information__link">Woman</a></li>
                    <li class="information__list"><a href="" class="information__link">Child</a></li>
                    <li class="information__list"><a href="" class="information__link">Apparel</a></li>
                    <li class="information__list"><a href="" class="information__link">Brows All</a></li>
                </ul>
            </div>
        </div>
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
<script src="<?= DIR_TO_PROD ?>/js/jquery-3.2.1.min.js?v=<?=APP_VERSION?>"></script>
<script src="<?= DIR_TO_PROD ?>/js/user_1.js?v=<?=APP_VERSION?>"></script>
<script src="<?= DIR_TO_PROD ?>/js/<?=$this->params['jsname']?>.js?v=<?=APP_VERSION?>"></script>
</head>
</html>