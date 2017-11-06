<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\User;

class LoginController extends Controller {
    public function actionIndex () {
        $this->layout = 'layout_guest';
        echo $this->render('login', [
            'cssname' => 'login',
            'jsname' => 'login'
        ]);
    }

    public function actionAjax () {
        $result = false;
        if (isset($_GET['user']) && isset($_GET['password'])) {
            $user = new User();
            $result = $user->check($_GET['user'], md5($_GET['password']));
        }
        $result = [
            'result' => $result ? 1 : 0
        ];
        echo json_encode($result);
    }

    public function actionOut () {
        $user = new User();
        $user->removeCookies();
        header('Location: /');
    }
}