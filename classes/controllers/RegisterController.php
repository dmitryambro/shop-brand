<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\User;
use classes\models\Categories;
use classes\models\Products;

class RegisterController extends Controller {
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

        $products = new Products();

        $this->layout = 'layout';
        echo $this->render('register', array(
            'cssname' => array('register'),
            'jsname' => array('Cart', 'register'),
            'islogin' => $user->checkFromCookies(),
            'user_data' => $user->data,
            'categories_list' => $categoriesList,
            'featured_products_list' => $products->getFeaturedProducts(1,8)
        ));
    }

    public function actionAjax () {
        $data = [];
        $result = true;
        $resultMessage = 'Error';
        if (!isset($_POST['username'])) $result = false;
        if (!isset($_POST['password'])) $result = false;
        if (!isset($_POST['email'])) $result = false;
        if (!isset($_POST['first_name'])) $result = false;
        if (!isset($_POST['last_name'])) $result = false;
        if ($result) {
            $data['username'] = $_POST['username'];
            $data['password'] = md5($_POST['password']);
            $data['email'] = $_POST['email'];
            $data['first_name'] = $_POST['first_name'];
            $data['last_name'] = $_POST['last_name'];
            $data['permission_id'] = 1;
            $user = new User();
            $result = $user->insert($data);
            $resultMessage = 'Error2';
        }
        $result = [
            'result' => $result ? 1 : 0,
            'resultMessage' => $resultMessage
        ];
        echo json_encode($result);
    }
}