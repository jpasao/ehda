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
        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/adminIndex.php';
        require_once APP . 'view/admin/includes/footer.php';        
    }

    public function posts()
    {   
        $userName = $_SESSION['name'];     
        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/posts/postIndex.php';
        require_once APP . 'view/admin/includes/footer.php';        
    }

    public function nuevoPost()
    {    
        $userName = $_SESSION['name'];    
        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/posts/addPost.php';
        require_once APP . 'view/admin/includes/footer.php';        
    }

    public function nuevaEtiqueta()
    {    
        $userName = $_SESSION['name'];    
        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/tags/addTag.php';
        require_once APP . 'view/admin/includes/footer.php';        
    }

    public function imagenes()
    {   
        $userName = $_SESSION['name'];     
        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/images/imageIndex.php';
        require_once APP . 'view/admin/includes/footer.php';        
    }

    public function nuevaImagen()
    {    
        $userName = $_SESSION['name'];    
        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/images/addImage.php';
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