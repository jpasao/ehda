<?php

class Articulos extends Controller
{
    private $operationName = 'artículos';
    public  function index()
    {        
        // Load default views
        require_once APP . 'view/public/includes/header.php';
        require_once APP . 'view/public/posts/index.php';
        require_once APP . 'view/public/includes/footer.php';
        
        require_once APP . 'core/logger.php';  
        Logger::debug('Acceso a ' . $this->operationName, false);                  
    }
}