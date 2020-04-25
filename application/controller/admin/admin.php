<?php

class Admin extends Controller
{
    public function __construct()
    {
        require_once APP . 'core/utils.php';      
        // If not logged, exit
        Utils::checkSession();
    }

    public function inicio()
    {  
        try 
        {            
            $userName = $_SESSION['name'];
            require_once APP . 'view/admin/includes/header.php';
            require_once APP . 'view/admin/includes/sideMenu.php';
            require_once APP . 'view/admin/adminIndex.php';
            require_once APP . 'view/admin/includes/footer.php';        
        } 
        catch (Exception $e) 
        {
			Utils::redirectToAdminErrorPage('carga de la página inicial de zona privada', $e);              
        }              
    }
}