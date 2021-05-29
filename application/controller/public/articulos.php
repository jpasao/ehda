<?php

class Articulos extends Controller
{
    private $operationName = 'artículos';
    public  function index()
    {  
        try 
        {
            require_once APP . 'core/utils.php';     
            require_once APP . 'core/logger.php';  
            Logger::debug('Acceso a ' . $this->operationName, false);  
            
            $posts = $this->modelPosts->GetPublicPostList();
    
            // Load default views
            require_once APP . 'view/public/includes/header.php';
            require_once APP . 'view/public/includes/menu.php';
            require_once APP . 'view/public/posts/index.php';
            require_once APP . 'view/public/includes/footer.php';            
        } 
        catch (Exception $e) 
        {
            Utils::redirectToErrorPage('listado de ' . $this->operationName, $e);
        }    
    }

    public function searchSlug($slug)
    {
        try { 
            require_once APP . 'core/utils.php';     
            require_once APP . 'core/logger.php';  
            Logger::debug('Acceso a búsqueda de ' . $this->operationName . ' según slug', false);

            $post = $this->modelPosts->GetPostBySlug($slug);

            // Load default view
            require_once APP . 'view/public/includes/header.php';
            require_once APP . 'view/public/includes/menu.php';
            require_once APP . 'view/public/posts/articulo.php';
            require_once APP . 'view/public/includes/footer.php';              
        }
        catch (Exception $e) 
        {
            Utils::redirectToErrorPage('listado de ' . $this->operationName, $e);
        }    
    }
}