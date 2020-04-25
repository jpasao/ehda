<?php

class Articulos extends Controller
{
    public  function index()
    {
        // Load default views
        require_once APP . 'view/public/includes/header.php';
        require_once APP . 'view/public/posts/index.php';
        require_once APP . 'view/public/includes/footer.php';
    }
}