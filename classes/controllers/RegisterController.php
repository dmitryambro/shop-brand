<?php

namespace classes\controllers;

use classes\base\Controller;
use classes\models\User;

class RegisterController extends Controller {
    public function actionIndex () {
        $this->layout = 'layout_guest';
        echo $this->render('register', [
            'cssname' => 'register',
            'jsname' => 'register'
        ]);
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