<?php

namespace classes\components;

class Request implements ComponentInterface {
    public $controller = 'main';
    public $action = 'index';
    public $namespaceController = '\classes\controllers';

    public function init () {
        $uri = $_SERVER['REQUEST_URI'];
        $path = explode('/', $uri);

        if (count($path) == 2) {
            if (!empty($path[1])) {
                $this->controller = $path[1];
            }
        } else {
            if (!empty($path[1])) {
                $this->controller = $path[1];
            }

            if (!empty($path[2])) {
                $actionName = $path[2];

                if (mb_strpos($actionName, '?') !== false) {
                    $actionName = mb_substr($actionName, 0, mb_strpos($actionName, '?'));
                }
                $this->action = $actionName;
            }
        }

        $this->callController();
    }

    protected function callController () {
        $classController = $this->namespaceController . '\\' . ucwords($this->controller) . 'Controller';
        $actionMethod = 'action' . ucwords($this->action);

        if (class_exists($classController)) {
            $controllerIstance = new $classController;
        } else {
            echo "PAGE NOT FOUND!";
            exit(1);
        }

        if (method_exists($controllerIstance, $actionMethod)) {
            call_user_func_array([$controllerIstance, $actionMethod], []);
        } else {
            echo "PAGE NOT FOUND!";
            exit(1);
        }
    }
}