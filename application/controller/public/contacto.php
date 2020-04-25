<?php

class Contacto extends Controller
{
    public  function index()
    {
        // Load default views
        require_once APP . 'view/public/includes/header.php';
        require_once APP . 'view/public/contact/index.php';
        require_once APP . 'view/public/includes/footer.php';
    }
}