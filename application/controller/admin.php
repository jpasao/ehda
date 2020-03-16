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

    public function inicio()
    {        
        $userName = $_SESSION['name'];
        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/adminIndex.php';
        require_once APP . 'view/admin/includes/footer.php';        
    }

    public function diasLibresCalendario()
    {    
        $userName = $_SESSION['name'];    
        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/calendar/addBusyDays.php';
        require_once APP . 'view/admin/includes/footer.php';        
    }
}