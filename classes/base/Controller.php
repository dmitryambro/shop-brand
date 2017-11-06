<?php

namespace classes\base;

abstract class Controller {
    public $layout = 'layout';
    public $params = [];

    public function render ($view, $params = []) {
        if (is_array($params)) {
            $this->params = $params;
        }

        $layout = $this->layout;

        $fileLayout = App::BASE_DIR_CLASSES . DIRECTORY_SEPARATOR
            . 'views' . DIRECTORY_SEPARATOR . $layout . '.php';

        $fileView = App::BASE_DIR_CLASSES . DIRECTORY_SEPARATOR
            . 'views' . DIRECTORY_SEPARATOR . $view . '.php';

        if (file_exists($fileLayout) && file_exists($fileView)) {
            ob_start();
            require_once $fileLayout;
            $layoutCode = ob_get_clean();

            ob_start();
            require_once $fileView;
            $viewCode = ob_get_clean();

            $data = str_replace('<div class="content-main"></div>', $viewCode, $layoutCode);
            return $data;
        } else {
            throw new \Exception('layout not found!!!' . $fileLayout);
        }
    }
}