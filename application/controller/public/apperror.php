<?php

class AppError extends Controller
{
    public function index()
    {
        ini_set('session.use_cookies', '0');
        require_once APP . 'view/public/includes/header.php';
        require_once APP . 'view/public/error/index.php';
        require_once APP . 'view/public/includes/footer.php';
    }    
}