<?php

class Etiquetas extends Controller
{
    public function guardar($id)
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
        require_once APP . 'view/admin/tags/saveTag.php';
        require_once APP . 'view/admin/includes/footer.php';        
    }

    public function lista()
    {
        $userName = $_SESSION['name'];   
        $tags = $this->modelTags->GetTagList();

        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/tags/tagIndex.php';
        require_once APP . 'view/admin/includes/deleteModal.php';
        require_once APP . 'view/admin/includes/footer.php'; 
    }

    public function save()
    {
        if (isset($_POST['save'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $this->modelTags->SaveTag($id, $name);
        }

        header('location: ' . URL . PAGE_TAG_LIST);
    }

    public function delete($id)
    {
        $this->modelTags->DeleteTag($id);
        header('location: ' . URL . PAGE_TAG_LIST);
    }
}