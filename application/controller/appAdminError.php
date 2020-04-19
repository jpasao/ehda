<?php

class AppAdminError extends Controller
{
    public function index()
    {
        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/includes/adminError.php';
        require_once APP . 'view/admin/includes/footer.php';
    }    
}