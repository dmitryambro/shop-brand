<?php

namespace classes\base;

use classes\components\Request;
use classes\components\Db;

class App {
    const BASE_DIR_CLASSES = __DIR__ . DIRECTORY_SEPARATOR . '..';

    /* @var self */
    public static $app;

    /* @var Request */
    public $request;

    /* @var Db */
    public $db;

    private function __construct () {}
    private function __wakeup () {}
    private function __clone () {}

    public static function run ($config = null) {
        if (empty(self::$app)) {
            self::$app = new self();

            // Db
            self::$app->db = new Db();
            self::$app->db->init();

            // Request
            self::$app->request = new Request();
            self::$app->request->init();
        }
        return self::$app;
    }
}
