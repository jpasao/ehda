<?php

class AppError extends Controller
{
    public function index()
    {
        require_once APP . 'view/includes/header.php';
        require_once APP . 'view/error/index.php';
        require_once APP . 'view/includes/footer.php';
    }    
}