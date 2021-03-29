<?php

class Inicio extends Controller
{
    private $operationName = 'inicio';
    public  function index()
    {
        // Load default views
        require_once APP . 'view/public/includes/header.php';
        require_once APP . 'view/public/home/index.php';
        require_once APP . 'view/public/includes/footer.php';

        require_once APP . 'core/logger.php';  
        Logger::debug('Acceso a ' . $this->operationName, false); 
    }
}