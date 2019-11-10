<?php

class Imagenes extends Controller
{
    public function guardar($id)
    {
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
        require_once APP . 'view/admin/images/saveImage.php';
        require_once APP . 'view/admin/includes/footer.php'; 
    }

    public function lista()
    {
        $userName = $_SESSION['name'];
        $images = $this->modelImages->GetImageList();

        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/images/imageIndex.php';
        require_once APP . 'view/admin/includes/footer.php'; 
    }

    public function save()
    {
        if (isset($_POST['save'])){
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
                header('location: ' . URL . PAGE_IMAGE_LIST);                
            }
            else 
            {
                header('location: ' . URL . PAGE_IMAGE_SAVE . 'error' . $error);
            }
        }        
    }

    public function delete($id)
    {
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
}