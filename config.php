<?php
    ob_start();

    if(!defined('ABSPATH')) {
        define('ABSPATH', dirname(__FILE__) . '/');
    }

    require_once("includes/class/posts.php");

    define("DB_NAME", "manage_posts");

    define("DB_USER", "root");

    define("DB_PASSWORD", "");

    define("DB_HOST", "localhost");

//    $database = Database::connectToDatabase(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $database = new Database(DB_HOST, DB_USER, DB_PASSWORD);

    $database->createDatabase(DB_NAME);

    $connection = $database->getConnection();

