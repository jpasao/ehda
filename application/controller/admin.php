<?php

class Admin extends Controller
{
    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['logged']))
        {
            header('location: ' . URL . 'login');
            exit();
        }
    }

    public function index()
    {
        $userName = $_SESSION['name'];
        // Load views
        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/posts/index.php';
        require_once APP . 'view/admin/includes/footer.php';        
    }
}