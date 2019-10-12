<?php

class Controller
{
    public $db = null;
    public $model = null;
    public $modelLogin = null;
    
    public function __construct()
    {
        $this->openDBConnection();
        $this->loadModel();            
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
        require_once APP . 'model/modellogin.php';      
        $this->model = new Model($this->db);  
        $this->modelLogin = new ModelLogin($this->db);      
    }
}