<?php

namespace classes\models;

use classes\base\App;

class Catalog {
    public function getAll ($from, $limit) {
        $pdo = APP::$app->db->pdo;
        try {
            $sql = 'SELECT * FROM `catalog` WHERE `id` > ' . $from . ' LIMIT ' . $limit;
            $rows = $pdo->query($sql);
            return $rows->fetchAll();
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getOne ($id) {
        $pdo = APP::$app->db->pdo;
        try {
            $sql = 'SELECT * FROM `catalog` WHERE `id` = ' . $id;
            $rows = $pdo->query($sql);
            $result = $rows->fetchAll();
            if (count($result) === 1) return $result[0];
            return [];
        } catch (\PDOException $e) {
            return [];
        }
    }
}