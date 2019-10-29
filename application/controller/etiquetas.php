<?php

class Etiquetas extends Controller
{
    public function nueva()
    {
        if (isset($_POST['save'])){
            $name = $_POST['name'];
            $this->modelTags->SaveTag(0, $name);
        }

        header('location: ' . URL . PAGE_TAG_LIST);
    }

    public function lista()
    {
        $userName = $_SESSION['name'];   
        $tags = $this->modelTags->GetTagList();

        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/tags/tagIndex.php';
        require_once APP . 'view/admin/includes/footer.php'; 
    }
}