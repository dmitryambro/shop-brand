<?php

namespace classes\models;

use classes\base\App;


class Products {
    private $select = 'SELECT `product`.*, `category`.`name` as `category_name`, `sub_category`.`name` AS `sub_cateogry_name` FROM `product` LEFT JOIN `category` ON `product`.`category_id` = `category`.`id` LEFT JOIN `sub_category` ON `product`.`sub_category_id` = `sub_category`.`id`';

    public function add ($data) {
        $sql_names = array();
        $sql_values = array();
        foreach ($data as $name => $value) {
            array_push($sql_names, '`' . $name . '`');
            array_push($sql_values, '"' . $value . '"');
        }

        $sql = 'INSERT INTO `product` (' . implode(',', $sql_names) . ') VALUES (' . implode(',', $sql_values) . ')';
        $pdo = APP::$app->db->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function edit ($data, $id) {
        $sql_values = array();
        foreach ($data as $name => $value) {
            $val = '`' . $name . '` = "' . $value . '"';
            array_push($sql_values, $val);
        }
        $sql = 'UPDATE `product` SET ' . implode(',', $sql_values) . ' WHERE `id` = ' . $id;
        $pdo = APP::$app->db->pdo;
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function get ($limitOnPage, $page, $categoriesIds, $subCategoriesIds) {
        $start = $limitOnPage * ($page - 1);
        if (empty($subCategoriesIds)) {
            $sql = $this->select . ' ORDER BY `product`.`add_tmst` DESC LIMIT ' . $limitOnPage . ' OFFSET ' . $start;
        } else {
            $subCategoriesIds = explode(',', $subCategoriesIds);
            $selectSubCategories = array();
            foreach ($subCategoriesIds as $subCategoryId) {
                array_push($selectSubCategories, '`sub_category_id` = ' . $subCategoryId);
            }
            $selectSubCategories = implode(' OR ', $selectSubCategories);
            $sql = $this->select . ' WHERE ' . $selectSubCategories . ' ORDER BY `product`.`add_tmst` DESC LIMIT ' . $limitOnPage . ' OFFSET ' . $start;
        }
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return array();
        }
    }

    public function getOne ($id) {
        $sql = $this->select . ' WHERE `id` = '  . $id;
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            $result = $rows->fetchAll();
            if (count($result) == 0) return array();
            return $result[0];
        } catch (\PDOException $e) {
            return array();
        }
    }

    public function getByIds ($ids) {
        $ids = explode(',', $ids);
        $sql_ids = array();
        foreach ($ids as $id) {
            array_push($sql_ids, '`product`.`id` = ' . $id);
        }
        $sql_ids = implode(' OR ', $sql_ids);
        $sql = $this->select . ' WHERE ' . $sql_ids;
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return array();
        }
    }

    public function getRowsCount ($sql) {
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            $result = $rows->fetchAll();
            if (count($result) == 0) return 0;
            return $result[0]['count(*)'];
        } catch (\PDOException $e) {
            return 0;
        }
    }

    public function getFilterByCategories ($sqlCategories, $like, $page, $limit) {
        $start = $limit * ($page - 1);
        $sql = $this->select . ' WHERE (' . implode(' OR ', $sqlCategories) . ') AND (' . $like . ') ORDER BY `product`.`add_tmst` DESC LIMIT ' . $limit . ' OFFSET ' . $start;
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return array();
        }
    }

    public function getFilterBySubCategories ($sqlSubCategories, $like, $page, $limit) {
        $start = $limit * ($page - 1);
        $sql = $this->select . ' WHERE (' . implode(' OR ', $sqlSubCategories) . ') AND (' . $like . ') ORDER BY `product`.`add_tmst` DESC LIMIT ' . $limit . ' OFFSET ' . $start;
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return array();
        }
    }

    public function getFeaturedProducts2 ($like, $page, $limit = 5) {
        $start = $limit * ($page - 1);
        $sql = $this->select . ' WHERE ' . $like . ' ORDER BY `product`.`add_tmst` DESC LIMIT ' . $limit . ' OFFSET ' . $start;
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return array();
        }
    }

    public function getFeaturedProducts ($page, $limit = 5) {
        $start = $limit * ($page - 1);
        $sql = $this->select . ' ORDER BY `product`.`add_tmst` DESC LIMIT ' . $limit . ' OFFSET ' . $start;
        $pdo = APP::$app->db->pdo;
        try {
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return array();
        }
    }
}