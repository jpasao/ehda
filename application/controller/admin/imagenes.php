<?php

class Imagenes extends Controller
{
    private $operationName = 'imágenes';
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
            $image = null;
    
            switch($id)
            {
                case 'nueva':
                case 'error':
                    $literal = 'Añadir';
                    break;
                default:
                    $literal = 'Modificar';
                    $image = $this->modelImages->GetImage($id);
                    break;
            } 
    
            require_once APP . 'view/admin/includes/header.php';
            require_once APP . 'view/admin/includes/sideMenu.php';
            require_once APP . 'view/admin/images/saveImage.php';
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
            $images = $this->modelImages->GetImageList();
    
            require_once APP . 'view/admin/includes/header.php';
            require_once APP . 'view/admin/includes/sideMenu.php';
            require_once APP . 'view/admin/images/imageIndex.php';
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
                
                // Upload first, then save to DB           
                $error = 0;
                $fileName = null;
                $fileSize = 0;
                $saveToDb = false;
           
                $attachedImage = $_FILES["filename"]["error"] != 4;
                            
                if ($attachedImage)
                {
                    if ($id != 0)
                    {
                        // Delete old image from disk
                        $image = $this->modelImages->GetImage($id);                 
                        $filenamePath = IMG_DIR . $image->filename;
                        unlink($filenamePath);
                    }
         
                    // Get upload data
                    $fileName = $_FILES['filename']['name'];
                    $fileSize = $_FILES['filename']['size'];
                    $fileTmpName  = $_FILES['filename']['tmp_name'];
                    $uploadPath = IMG_DIR . basename($fileName); 
    
                    //Format validation
                    $check = getimagesize($fileTmpName);
                    if ($check === false)
                    {
                        $error = 2;
                    }
    
                    // Size validation
                    if ($fileSize > 2000000) {
                        $error = 1;
                    } 
                    
                    $didUpload = false;
    
                    if ($error == 0)
                    {
                        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                    }
                    if ($didUpload)
                    {
                        $saveToDb = true;
                    }
                }
                else 
                {
                    $image = $this->modelImages->GetImage($id);
                    $fileName = $image->filename;
                    $saveToDb = true;                    
                }            
    
                if ($saveToDb)
                {
                    $this->modelImages->SaveImage($id, $name, $fileName);  
                    Logger::debug('Fin de guardado de ' . $this->operationName, true);                      
                    header('location: ' . URL . PAGE_IMAGE_LIST);                
                }
                else 
                {
                    Logger::error('Fin de guardado de ' . $this->operationName, true);
                    header('location: ' . URL . PAGE_IMAGE_SAVE . 'error' . $error);
                }
            }        
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
                
            // First delete image on disk
            $image = $this->modelImages->GetImage($id);
            if (empty($image) == false)
            {
                $filenamePath = IMG_DIR . $image->filename;
                $isDeleted = unlink($filenamePath);
    
                if ($isDeleted)
                {
                    // Once deleted, delete BD record
                    $this->modelImages->DeleteImage($id);                              
                }
            }
            header('location: ' . URL . PAGE_IMAGE_LIST);
        } 
        catch (Exception $e) 
        {
			Utils::redirectToAdminErrorPage('borrado de ' . $this->operationName, $e);
        }
    }
}