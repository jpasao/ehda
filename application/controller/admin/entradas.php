<?php

class Entradas extends Controller
{
    private $operationName = 'entrada';
    public function __construct()
    {
        parent::__construct();
        require_once APP . 'core/utils.php';     
        require_once APP . 'core/logger.php';         
        Utils::checkSession();
    }

    public function guardar($id)
    {
        try 
        {       
            Logger::debug('Acceso a guardado de ' . $this->operationName . '. Id: ' . $id, true);                  
            $userName = $_SESSION['name'];    
    
            $literal;
            $post = null;
            $tags = $this->modelTags->GetTagList();
            $selectedTags = [];
            $images = $this->modelImages->GetImageList();
            $selectedImage = [];
    
            if ($id == 'nueva')
            {
                $literal = 'Añadir';
            }
            else 
            {
                $literal = 'Modificar';
                $post = $this->modelPosts->GetPost($id);
                $selectedImage = $this->modelImages->GetImagesByPost($id);
                $selectedTags = $this->modelTags->GetTagsByPost($id);
            }
    
            require_once APP . 'view/admin/includes/header.php';
            require_once APP . 'view/admin/includes/sideMenu.php';
            require_once APP . 'view/admin/posts/savePost.php';
            require_once APP . 'view/admin/includes/footer.php';         
        } 
        catch (Exception $e) 
        {
            Utils::redirectToAdminErrorPage('carga del guardado de ' . $this->operationName, $e);              
        }
    }

    public function save()
    {
        try 
        {            
            if (isset($_POST['save']))
            {
                Logger::debug('Inicio de guardado de ' . $this->operationName . '. Parámetros: ' . json_encode($_POST), true);
                $id = $_POST['id'];
                $title = $_POST['title'];
                $body = $_POST['bodyTag'];
                $tags = $_POST['tags'];
                $image = $_POST['image'];
    
                // Post data
                $this->modelPosts->SavePost($id, $title, $body);
                if ($id == 0)
                {
                    // Get the new inserted id to save tags and image
                    $id = $this->model->GetLastInsertedId();
                }
    
                // Post tags data
                $this->modelTags->SavePostTags($id, $tags);
    
                // Post image data
                $this->modelImages->SavePostImages($id, $image);
            }
            Logger::debug('Fin de guardado de ' . $this->operationName, true);
            header('location: ' . URL . PAGE_POST_LIST);
        }        
        catch (Exception $e) 
        {
            Utils::redirectToAdminErrorPage('guardado de ' . $this->operationName, $e);               
        }
    }

    public function lista()
    {
        try 
        {    
            Logger::debug('Acceso a listado de ' . $this->operationName, true);          
            $userName = $_SESSION['name'];    
            $posts = $this->modelPosts->GetPostList();
            
            require_once APP . 'view/admin/includes/header.php';
            require_once APP . 'view/admin/includes/sideMenu.php';
            require_once APP . 'view/admin/posts/postIndex.php';
            require_once APP . 'view/admin/includes/deleteModal.php';
            require_once APP . 'view/admin/includes/footer.php'; 
        } 
        catch (Exception $e) 
        {
            Utils::redirectToAdminErrorPage('listado de ' . $this->operationName, $e);                
        }        
    }

    public function delete($id)
    {
        try 
        {            
            Logger::debug('Borrado de ' . $this->operationName . '. Id: ' . $id, true);    
            $this->modelPosts->DeletePost($id);
            header('location: ' . URL . PAGE_POST_LIST);
        } 
        catch (Exception $e) 
        {
            Utils::redirectToAdminErrorPage('borrado de ' . $this->operationName, $e);               
        }        
    }
}