<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\Catalog;

class CatalogController extends Controller {
    public function actionIndex () {
        $catalog = new Catalog;

        echo $this->render('catalog', [
            'title' => 'CATALOG',
            'catalog' => $catalog->getAll(0, 10)
        ]);
    }

    public function actionDetail () {
        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $catalog = new Catalog;
        $data = $catalog->getOne($id);

        if (count($data) == 0) {
            echo $this->render('page_not_found', [
                'title' => 'Error'
            ]);
            exit();
        }
        echo $this->render('catalog_detail', [
            'title' => 'CATALOG ' . $data['title'],
            'data' => $data
        ]);

    }
}