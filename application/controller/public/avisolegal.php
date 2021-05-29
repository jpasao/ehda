<?php

class AvisoLegal extends Controller
{
    private $operationName = 'avisolegal';
    public  function index()
    {
        // Load default views
        require_once APP . 'view/public/includes/header.php';
        require_once APP . 'view/public/includes/menu.php';
        require_once APP . 'view/public/legal/legal.php';
        require_once APP . 'view/public/includes/footer.php';

        require_once APP . 'core/logger.php';  
        Logger::debug('Acceso a ' . $this->operationName, false); 
    }
}