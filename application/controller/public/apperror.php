<?php

class AppError extends Controller
{
    public function index()
    {
        require_once APP . 'view/public/includes/header.php';
        require_once APP . 'view/public/error/index.php';
        require_once APP . 'view/public/includes/footer.php';
    }    
}