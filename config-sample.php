<?php
    ob_start();

    if(!defined('ABSPATH')) {
        define('ABSPATH', dirname(__FILE__) . '/');
    }

    require_once("includes/class/posts.php");

    define("DB_NAME", "database_name");

    define("DB_USER", "user");

    define("DB_PASSWORD", "password");

    define("DB_HOST", "host");

//    $database = Database::connectToDatabase(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $database = new Database(DB_HOST, DB_USER, DB_PASSWORD);

    $database->createDatabase(DB_NAME);

    $connection = $database->getConnection();

