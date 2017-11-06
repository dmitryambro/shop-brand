<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\Categories;
use classes\models\User;
use classes\models\Products;

class ProductsController extends Controller {
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

        $selectCategories = isset($_GET['category_ids']) ? explode(',', $_GET['category_ids']) : array();
        $selectSubCategories = isset($_GET['sub_category_ids']) ? explode(',', $_GET['sub_category_ids']) : array();
        $searchText = isset($_GET['search_text']) ? $_GET['search_text'] : '';
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($page < 1) $page = 1;

        $limit = 8;

        if (count($selectCategories) == 0) $selectSubCategories = array();

        if (count($selectCategories) == 0 && count($selectSubCategories) == 0) {
            $like = '`name` LIKE "' . $searchText . '" OR `description` LIKE "' . $searchText . '"';
            $viewProductsList = $products->getFeaturedProducts2($like, $page, $limit);
            $pages = ceil(intval($products->getRowsCount('SELECT count(*) FROM `product` WHERE ' . $like)) / $limit);
            $gets = '?';
            $gets.= 'search_text=' . $searchText;
            $gets.= '&page=';
            $page_link = '/products/filter/' . $gets;
        } else if (count($selectCategories) > 0 && count($selectSubCategories) == 0) {
            $sqlCategories = array();
            foreach ($selectCategories as $category) {
                array_push($sqlCategories, '`category_id` = ' . $category);
            }
            $like = '`name` LIKE "' . $searchText . '" OR `description` LIKE "' . $searchText . '"';
            $viewProductsList = $products->getFilterByCategories($sqlCategories, $like, $page, $limit);
            $sql = 'SELECT count(*) FROM `product` WHERE (' . implode(' OR ', $sqlCategories) . ') AND (' . $like . ')';
            $pages = ceil(intval($products->getRowsCount($sql)) / $limit);
            $gets = '?';
            $gets.= 'category_ids=' . implode(',', $selectCategories);
            $gets.= '&search_text=' . $searchText;
            $gets.= '&page=';
            $page_link = '/products/filter/' . $gets;
        } else {
            $sqlSubCategories = array();
            foreach ($selectSubCategories as $subCategory) {
                array_push($sqlSubCategories, '`sub_category_id` = ' . $subCategory);
            }
            $like = '`name` LIKE "' . $searchText . '" OR `description` LIKE "' . $searchText . '"';
            $viewProductsList = $products->getFilterBySubCategories($sqlSubCategories, $like, $page, $limit);
            $sql = 'SELECT count(*) FROM `product` WHERE (' . implode(' OR ', $sqlSubCategories) . ') AND (' . $like . ')';
            $pages = ceil(intval($products->getRowsCount($sql)) / $limit);
            $gets = '?';
            $gets.= 'category_ids=' . implode(',', $selectCategories);
            $gets.= '&sub_category_ids=' . implode(',', $selectSubCategories);
            $gets.= '&search_text=' . $searchText;
            $gets.= '&page=';
            $page_link = '/products/filter/' . $gets;
        }

        $this->layout = 'layout';
        echo $this->render('products', array(
            'cssname' => array('main'),
            'jsname' => array('Cart', 'Filter', 'Products'),
            'islogin' => $user->checkFromCookies(),
            'user_data' => $user->data,
            'categories_list' => $categoriesList,
            'featured_products_list' => $viewProductsList,
            'pages' => $pages,
            'page_link' => $page_link
        ));
    }

    public function actionFilter () {
        $this->actionIndex();
    }

    public function actionAjaxGetByIds () {
        if (!isset($_GET['ids'])) {
            echo json_encode(array(
                'result' => '0',
                'message' => 'set ids'
            ));
            return false;
        }
        $products = new Products();
        echo json_encode(array(
           'result' => '1',
           'products' =>  $products->getByIds($_GET['ids'])
        ));
    }
}