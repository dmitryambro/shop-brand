<?php

namespace classes\models;

use classes\base\App;

class User {

    public $data = array();
    public $login = false;

    public function setCookies () {
        setCookie('username', $this->data['username'], time() + 31 * 24 * 3600, '/');
        setCookie('password', $this->data['password'], time() + 31 * 24 * 3600, '/');
    }

    public function insert ($data) {
        $indexs = array();
        $values = array();
        foreach ($data as $index => $value) {
            array_push($indexs, '`' . $index . '`');
            array_push($values, '"' . $value . '"');
        }
        $sql = 'INSERT INTO `user` ('
            . implode($indexs, ',')
            . ') VALUES ('
            . implode($values, ',')
            . ')';
        $pdo = APP::$app->db->pdo;
        try {
            $pdo->query($sql);
            $this->data = $data;
            $this->setCookies();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function check ($username, $password) {
        $this->login = false;
        $sql = 'SELECT * FROM `user` WHERE `username` = "' . $username . '"';
        $pdo = APP::$app->db->pdo;
        try {
            $this->data = array();
            $rows = $pdo->query($sql);
            $result = $rows->fetchAll();
            if (count($result) > 0) {
                if ($result[0]['password'] === $password) {
                    $this->data = $result[0];
                    $this->setCookies();
                    $this->login = true;
                    return true;
                }
            }
            return false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function checkFromCookies () {
        $username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
        $password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
        return $this->check($username, $password);
    }

    public function removeCookies () {
        setCookie('username', null, time() - 3600, '/');
        setCookie('password', null, time() - 3600, '/');
    }

    public function getUsers ($page, $limit) {
        $sql = 'SELECT `user`.`id`, `user`.`username`, `user`.`first_name`, `user`.`last_name`, `user`.`email`, `permission`.`name` AS `permission_name`, `permission`.`id` AS `permission_id` FROM `user` LEFT JOIN `permission` ON `user`.`permission_id` = `permission`.`id`';
        $pdo = APP::$app->db->pdo;
        try {
            $this->data = array();
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function update ($id, $data) {
        $sql_data = array();
        foreach ($data as $key => $val) {
            array_push($sql_data, '`' . $key . '` = "' . $val . '"');
        }
        $sql = 'UPDATE `user` SET ' . implode(', ', $sql_data) . ' WHERE `id` = ' . $id;
        $pdo = APP::$app->db->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}