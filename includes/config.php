<?php
    ob_start();

    require_once ("class/posts.php");

    define("DB_NAME", "manage_posts");

    define("DB_USER", "root");

    define("DB_PASSWORD", "");

    define("DB_HOST", "localhost");

    $database = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    $connection = $database->getConnection();

