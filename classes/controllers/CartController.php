<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\Categories;
use classes\models\User;
use classes\models\Products;

class CartController extends Controller {
    public function actionIndex () {
        $user = new User();
        $categories = new Categories();
        $categoriesAndSubList = $categories->getCategoriesAndSubCategories();
        $categoriesList = array();
        foreach ($categoriesAndSubList as $item) {
            if (empty($categoriesList[$item['category_id']])) {
                $categoriesList[$item['category_id']] = array(
                    'id' => $item['category_id'],
                    'href' => '/products/filter/?category_ids=' . $item['category_id'],
                    'name' => $item['name'],
                    'subs' => array()
                );
            }
            array_push($categoriesList[$item['category_id']]['subs'], array(
                'id' => $item['sub_id'],
                'href' => '/products/filter/?category_ids=' . $item['category_id'] . '&sub_category_ids=' . $item['sub_id'],
                'name' => $item['sub_name']
            ));
        }

        $this->layout = 'layout';
        echo $this->render('cart', array(
            'cssname' => array('main'),
            'jsname' => array('Cart', 'CartPage'),
            'islogin' => $user->checkFromCookies(),
            'user_data' => $user->data,
            'categories_list' => $categoriesList
        ));
    }
}