<?php

class Entradas extends Controller
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
        require_once APP . 'view/admin/posts/savePost.php';
        require_once APP . 'view/admin/includes/footer.php';         
    }

    public function save()
    {
        if (isset($_POST['save']))
        {
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

        header('location: ' . URL . PAGE_POST_LIST);
    }

    public function lista()
    {
        $userName = $_SESSION['name'];    
        $posts = $this->modelPosts->GetPostList();
        
        require_once APP . 'view/admin/includes/header.php';
        require_once APP . 'view/admin/posts/postIndex.php';
        require_once APP . 'view/admin/includes/deleteModal.php';
        require_once APP . 'view/admin/includes/footer.php'; 
    }

    public function delete($id)
    {
        $this->modelPosts->DeletePost($id);
        header('location: ' . URL . PAGE_POST_LIST);
    }
}