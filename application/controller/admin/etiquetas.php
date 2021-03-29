<?php

class Etiquetas extends Controller
{
    private $operationName = 'etiquetas';
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
            Utils::redirectToAdminErrorPage('carga del guardado de ' . $this->operationName, $e);        
        } 
    }

    public function lista()
    {
        try 
        {        
            Logger::debug('Acceso a listado de ' . $this->operationName, true);              
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
            Utils::redirectToAdminErrorPage('listado de ' . $this->operationName, $e);            
        }
    }

    public function save()
    {
        try 
        {            
            if (isset($_POST['save'])){
                Logger::debug('Inicio de guardado de ' . $this->operationName . '. Parámetros: ' . json_encode($_POST), true);
                $id = $_POST['id'];
                $name = $_POST['name'];
                $this->modelTags->SaveTag($id, $name);
            }
    
            Logger::debug('Fin de guardado de ' . $this->operationName, true);
            header('location: ' . URL . PAGE_TAG_LIST);
        } 
        catch (Exception $e) 
        {
			Utils::redirectToAdminErrorPage('guardado de ' . $this->operationName, $e);
        }
    }

    public function delete($id)
    {
        try 
        {            
            Logger::debug('Borrado de ' . $this->operationName . '. Id: ' . $id, true);    
            $this->modelTags->DeleteTag($id);
            header('location: ' . URL . PAGE_TAG_LIST);
        } 
        catch (Exception $e) 
        {
			Utils::redirectToAdminErrorPage('borrado de ' . $this->operationName, $e);
        }
    }
}