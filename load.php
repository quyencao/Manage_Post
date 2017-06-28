<?php
    if(!defined('ABSPATH')) {
        define('ABSPATH', dirname(__FILE__) . '/');
    }

    if(file_exists(ABSPATH . 'config.php')) {
        require_once (ABSPATH . 'config.php');
        header("Location: list_posts.php");
    } else {
        define('INC', 'includes');
        $path = INC . '/setup-config.php';
        header('Location: '. $path);
    }