<?php

namespace classes\components;

use PDO;

class Db implements ComponentInterface {
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;
    private $charset = DB_CHARSET;

    public $pdo;

    public function init () {
        $dsn = 'mysql:host:' . $this->host . ':' . $this->port . ';'
            . 'dbname=' . $this->dbname . ';'
            . 'charset=' . $this->charset;

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
        $this->pdo->exec("use " . $this->dbname);
        return true;
    }
}