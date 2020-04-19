<?php

class Etiquetas extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once APP . 'core/utils.php';      
        // If not logged, exit
        Utils::checkSession();
    }

    public function guardar($id)
    {   
        try 
        {            
            $userName = $_SESSION['name'];    
            $literal;
            $tag = null;
    
            if ($id == 'nueva')
            {
                $literal = 'Añadir';            
            }
            else
            {
                $literal = 'Modificar';
                $tag = $this->modelTags->GetTag($id);
            }
           
            require_once APP . 'view/admin/includes/header.php';
            require_once APP . 'view/admin/includes/sideMenu.php';
            require_once APP . 'view/admin/tags/saveTag.php';
            require_once APP . 'view/admin/includes/footer.php';        
        } 
        catch (Exception $e) 
        {
            Utils::redirectToAdminErrorPage('carga del guardado de etiquetas', $e);        
        } 
    }

    public function lista()
    {
        try 
        {            
            $userName = $_SESSION['name'];   
            $tags = $this->modelTags->GetTagList();
    
            require_once APP . 'view/admin/includes/header.php';
            require_once APP . 'view/admin/includes/sideMenu.php';
            require_once APP . 'view/admin/tags/tagIndex.php';
            require_once APP . 'view/admin/includes/deleteModal.php';
            require_once APP . 'view/admin/includes/footer.php'; 
        } 
        catch (Exception $e) 
        {
            Utils::redirectToAdminErrorPage('listado de etiquetas', $e);            
        }
    }

    public function save()
    {
        try 
        {            
            if (isset($_POST['save'])){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $this->modelTags->SaveTag($id, $name);
            }
    
            header('location: ' . URL . PAGE_TAG_LIST);
        } 
        catch (Exception $e) 
        {
			Utils::redirectToAdminErrorPage('guardado de etiquetas', $e);
        }
    }

    public function delete($id)
    {
        try 
        {            
            $this->modelTags->DeleteTag($id);
            header('location: ' . URL . PAGE_TAG_LIST);
        } 
        catch (Exception $e) 
        {
			Utils::redirectToAdminErrorPage('borrado de etiquetas', $e);
        }
    }
}