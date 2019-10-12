<?php
    define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
    define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
    require_once APP . 'config/config.php';
    require_once APP . 'core/application.php';    
    require_once APP . 'core/controller.php';
    require_once ROOT . 'vendor/autoload.php';
 
    // Start app
    $app = new Application();