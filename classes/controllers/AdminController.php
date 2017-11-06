<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\User;
use classes\models\Categories;
use classes\models\Products;

class AdminController extends Controller {
    public function actionIndex () {
        header('Location: /admin/products');
    }

    public function actionCategories () {
        $categoryId = isset($_GET['category']) ? $_GET['category'] : null;
        $categories = new Categories();
        $categoriesList = array();
        $subCategoriesList = array();
        $jsName = 'guest';
        $cssName = 'guest';
        $user = new User();
        if ($user->checkFromCookies()) {
            if ($user->data['permission_id'] == 0) {
                header('Location: /');
            }
            $this->layout = 'layout_admin';
            $categoriesList = $categories->getCategories();
            $categoryIdTrue = false;
            $categoryActiveIndex = null;
            if (empty($categoryId)) {
                if (count($categoriesList) > 0) {
                    $categoryId = $categoriesList[0]['id'];
                }
            }
            foreach ($categoriesList as $index => $category) {
                if ($category['id'] == $categoryId) {
                    $categoryIdTrue = true;
                    $categoryActiveIndex = $index;
                }
            }
            if (!$categoryIdTrue && !empty($categoryId)) {
                header('Location: /admin/categories');
            }
            if (!empty($categoryId)) {
                $subCategoriesList = $categories->getSubCategories($categoryId);
            }
            $jsName = 'AdminCategories';
            $cssName = 'admin';
        } else {
            $this->layout = 'layout_guest';
        }
        echo $this->render('admin_categories', array(
            'cssname' => $cssName,
            'jsname' => $jsName,
            'categories' => $categoriesList,
            'category_active_index' => $categoryActiveIndex,
            'sub_categories' => $subCategoriesList
        ));
    }

    public function actionProducts () {
        $user = new User();
        if ($user->checkFromCookies()) {
            $this->layout = 'layout_admin';
            echo $this->render('admin_products', array(
                'cssname' => 'admin',
                'jsname' => 'AdminProducts'
            ));
        } else {
            header('Location: /');
        }
    }

    public function actionUsers () {
        $user = new User();
        if ($user->checkFromCookies()) {
            $this->layout = 'layout_admin';
            echo $this->render('admin_users', array(
                'cssname' => 'admin',
                'jsname' => 'AdminUsers'
            ));
        } else {
            header('Location: /');
        }
    }

    public function actionAjaxAddCategory () {
        $categories = new Categories();
        if (isset($_POST['name'])) {
            $result = $categories->addCategory($_POST['name']);
            if ($result != false) {
                echo json_encode(array(
                    'result' => 1,
                    'id' => $result
                ));
                return false;
            }
        }
        echo json_encode(array(
            'result' => 0,
            'error_message' => 'error'
        ));
    }

    public function actionAjaxEditCategory () {
        $categories = new Categories();
        if (isset($_POST['id']) && isset($_POST['name'])) {
            $result = $categories->editCategory($_POST['id'], $_POST['name']);
            if ($result != false) {
                echo json_encode(array(
                    'result' => 1
                ));
                return false;
            }
        }
        echo json_encode(array(
            'result' => 0,
            'error_message' => 'error'
        ));
    }

    public function actionAjaxRemoveCategory () {
        $categories = new Categories();
        if (isset($_POST['id'])) {
            $result = $categories->removeCategory($_POST['id']);
            if ($result != false) {
                echo json_encode(array(
                    'result' => 1
                ));
                return false;
            }
        }
        echo json_encode(array(
            'result' => 0,
            'error_message' => 'error'
        ));
    }

    public function actionAjaxAddSubCategory () {
        $categories = new Categories();
        if (isset($_POST['id']) && isset($_POST['name'])) {
            $result = $categories->addSubCategory($_POST['id'], $_POST['name']);
            if ($result != false) {
                echo json_encode(array(
                    'result' => 1,
                    'id' => $result
                ));
                return false;
            }
        }
        echo json_encode(array(
            'result' => 0,
            'error_message' => 'error'
        ));
    }

    public function actionAjaxEditSubCategory () {
        $categories = new Categories();
        if (isset($_POST['id']) && isset($_POST['name'])) {
            $result = $categories->editSubCategory($_POST['id'], $_POST['name']);
            if ($result != false) {
                echo json_encode(array(
                    'result' => 1
                ));
                return false;
            }
        }
        echo json_encode(array(
            'result' => 0,
            'error_message' => 'error'
        ));
    }

    public function actionAjaxRemoveSubCategory () {
        $categories = new Categories();
        if (isset($_POST['id'])) {
            $result = $categories->removeSubCategory($_POST['id']);
            if ($result != false) {
                echo json_encode(array(
                    'result' => 1
                ));
                return false;
            }
        }
        echo json_encode(array(
            'result' => 0,
            'error_message' => 'error'
        ));
    }

    public function actionAjaxCategoriesAndSub () {
        $categories = new Categories();
        $categoriesList = array();
        $_categoriesList = $categories->getCategories();
        $subCategoriesList = $categories->getSubCategories();
        foreach ($_categoriesList as $category) {
            $categoriesList[$category['id']] = $category;
        }
        foreach ($subCategoriesList as $subCategory) {
            $category_id = $subCategory['category_id'];
            if (!empty($categoriesList[$category_id])) {
                if (empty($categoriesList[$category_id]['sub_categories'])) {
                    $categoriesList[$category_id]['sub_categories'] = array();
                }
                array_push($categoriesList[$category_id]['sub_categories'], $subCategory);
            }
        }
        echo json_encode(array(
            'status' => 1,
            'categories' => $categoriesList
        ));
    }

    public function actionAjaxAddProduct () {
        $user = new User();
        if ($user->checkFromCookies()) {
            if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['category'])
                && isset($_POST['subCategory']) && isset($_POST['price']) && isset($_POST['count'])
                && isset($_POST['weight']) && isset($_POST['size'])) {
                $products = new Products();
                $result = $products->add(array(
                    'name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'price' => $_POST['price'],
                    'add_tmst' => time(),
                    'last_edit_tmst' => time(),
                    'weight' => $_POST['weight'],
                    'size' => $_POST['size'],
                    'category_id' => $_POST['category'],
                    'sub_category_id' => $_POST['subCategory'],
                    'user_id' => $user->data['id'],
                    'count' => $_POST['count'],
                    'image_url' => $_POST['image_url']
                ));
                if ($result == false) {
                    echo json_encode(array('result' => '0'));
                    return false;
                }
                echo json_encode(array('result' => '1', 'id' => $result));
                return false;
            }
        }
        echo json_encode(array('result' => '0'));
    }

    public function actionAjaxEditProduct () {
        if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['category'])
            && isset($_POST['subCategory']) && isset($_POST['price']) && isset($_POST['count'])
            && isset($_POST['weight']) && isset($_POST['size']) && isset($_POST['id'])) {
            $products = new Products();
            $result = $products->edit(array(
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'last_edit_tmst' => time(),
                'weight' => $_POST['weight'],
                'size' => $_POST['size'],
                'category_id' => $_POST['category'],
                'sub_category_id' => $_POST['subCategory'],
                'count' => $_POST['count'],
                'image_url' => $_POST['image_url']
            ), $_POST['id']);
            if ($result == false) {
                echo json_encode(array('result' => '0'));
                return false;
            }
            echo json_encode(array('result' => '1', 'id' => $result));
            return false;
        }
        echo json_encode(array('result' => '0'));
    }

    public function actionAjaxGetProducts () {
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//        $categoriesIds = isset($_GET['categories_ids']) ? $_GET['categories_ids'] : null;
        $subCategoriesIds = isset($_GET['sub_categories_ids']) ? explode(',', $_GET['sub_categories_ids']) : array();
        $products = new Products();
        $like = '`name` LIKE "%"';
        if (count($subCategoriesIds) == 0 || $subCategoriesIds[0] == '') {
            $productsList = $products->getFeaturedProducts2($like, $page, $limit);
            $pages = ceil(intval($products->getRowsCount('SELECT count(*) FROM `product` WHERE ' . $like)) / $limit);
        } else {
            $sqlSubCategories = array();
            foreach ($subCategoriesIds as $subCategory) {
                array_push($sqlSubCategories, '`sub_category_id` = ' . $subCategory);
            }
            $productsList = $products->getFilterBySubCategories($sqlSubCategories, $like, $page, $limit);
            $sql = 'SELECT count(*) FROM `product` WHERE (' . implode(' OR ', $sqlSubCategories) . ') AND (' . $like . ')';
            $pages = ceil(intval($products->getRowsCount($sql)) / $limit);
        }
        echo json_encode(array(
            'result' => '1',
            'products' => $productsList,
            'pages' => $pages
        ));
    }

    public function actionAjaxGetProduct () {
        if (!isset($_GET['id'])) {
            echo json_encode(array('result' => '0', 'message' => 'id error'));
            return false;
        }
        $products = new Products();
        echo json_encode(array(
            'result' => '1',
            'product' => $products->getOne($_GET['id'])
        ));
    }

    public function actionAjaxUploadImage () {
        $fileTypes = array('jpeg','jpg','png','gif','PNG','JPEG','JPG');
        foreach ($_FILES as $file) {
            $name = $file['name'];
            $fileExt = pathinfo($name, PATHINFO_EXTENSION);
            $_name = substr($name, 0, strpos($name, $fileExt));
            $name = md5($_name) . '.' . $fileExt;
            $path = DIR_TO_UPLOAD . '/' . $name;
            $pathWeb = DIR_TO_UPLOAD_WEB . '/' . $name;
            if (in_array(strtolower($fileExt), $fileTypes)) {
                if ($file['name'] < 1000000) {
                    @move_uploaded_file($file['tmp_name'], $path);
                    echo json_encode(array('result' => '1', 'name' => $name, 'path' => $pathWeb));
                } else {
                    echo json_encode(array('result' => '0', 'message' => 'File size error'));
                    return false;
                }
            } else {
                echo json_encode(array('result' => '0', 'message' => 'File type error'));
                return false;
            }
        }
    }

    public function actionAjaxGetUsers () {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $user = new User();
        $users = $user->getUsers($page, $limit);
        echo json_encode(array('result' => 1, 'users' => $users));
    }

    public function actionAjaxSaveUser () {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $permission_id = isset($_POST['permission_id']) ? $_POST['permission_id'] : null;
        if (empty($id) || empty($first_name) || empty($last_name) || empty($email) || empty($permission_id)) {
            echo json_encode(array('result' => '0', 'message' => 'post data send error'));
            return false;
        }
        $user = new User();
        if ($user->update($id, array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'permission_id' => $permission_id
        ))) {
            echo json_encode(array('result' => '1'));
        } else {
            echo json_encode(array('result' => '0', 'message' => 'sql'));
        }
    }
}