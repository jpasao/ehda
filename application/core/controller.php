<?php

class Controller
{
    public $db = null;
    public $model = null;
    public $modelLogin = null;
    public $modelTags = null;
    public $modelImages = null;
    public $modelPosts  = null;
    
    public function __construct()
    {
        require_once APP . 'core/utils.php';    
        $this->openDBConnection();
        $this->loadModel();    
        $page = Utils::checkAdminPage();
        if(!isset($_SESSION) && $page['isAdmin']) 
        { 
            session_start(); 
        }       
    }

    private function openDBConnection()
    {
        // Set options for PDO
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        // Generate DB connection
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    public function loadModel()
    {
        require_once APP . 'model/model.php';  
        require_once APP . 'model/modelLogin.php';  
        require_once APP . 'model/modelTags.php';      
        require_once APP . 'model/modelImages.php'; 
        require_once APP . 'model/modelPosts.php';      
        
        $this->model = new Model($this->db);  
        $this->modelLogin = new ModelLogin($this->db);     
        $this->modelTags = new ModelTags($this->db);      
        $this->modelImages = new ModelImages($this->db);    
        $this->modelPosts = new ModelPosts($this->db);
    }
}