<?php

namespace classes\models;

use classes\base\App;

class Categories {
    public function getCategories ($id = null) {
        if (empty($id)) $sql = 'SELECT * FROM `category`';
        else $sql = 'SELECT * FROM `category` WHERE `id` = ' . $id;
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return array();
        }
    }

    public function getSubCategories ($id = null) {
        if (empty($id)) $sql = 'SELECT * FROM `sub_category`';
        else $sql = 'SELECT * FROM `sub_category` WHERE `category_id` = ' . $id;
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return array();
        }
    }

    public function getSubCategory ($id) {
        $sql = 'SELECT * FROM `sub_category` WHERE `id` = ' . $id;
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return array();
        }
    }

    public function addCategory ($name) {
        $sql = 'INSERT INTO `category` (`name`) VALUES ("' . $name . '")';
        $pdo = APP::$app->db->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function editCategory ($id, $name) {
        $sql = 'UPDATE `category` SET `name` = "' . $name . '" WHERE `id` = "' . $id . '"';
        $pdo = APP::$app->db->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function removeCategory ($id) {
        $sql = 'DELETE FROM `sub_category` WHERE `category_id` = ' . $id . ';';
        $sql.= 'DELETE FROM `category` WHERE `id` = ' . $id;
        $pdo = APP::$app->db->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function addSubCategory($id, $name) {
        $sql = 'INSERT INTO `sub_category` (`name`, `category_id`) VALUES ("' . $name . '", "' . $id . '")';
        $pdo = APP::$app->db->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function editSubCategory ($id, $name) {
        $sql = 'UPDATE `sub_category` SET `name` = "' . $name . '" WHERE `id` = "' . $id . '"';
        $pdo = APP::$app->db->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function removeSubCategory ($id) {
        $sql = 'DELETE FROM `sub_category` WHERE `id` = "' . $id . '"';
        $pdo = APP::$app->db->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getCategoriesAndSubCategories () {
        $sql = 'SELECT `sub_category`.`id` AS `sub_id`, `sub_category`.`name` AS `sub_name`, `sub_category`.`category_id`, `category`.`name` FROM `sub_category` RIGHT JOIN `category` ON `sub_category`.`category_id` = `category`.`id`';
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return false;
        }
    }
}