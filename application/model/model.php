<?php

class Model
{
    protected $sql = null;
    protected $date = null; 
    
    public function __construct($db)
    {
        require_once APP . 'core/utils.php';        
        try
        {
            $this->db = $db;
        }
        catch (PDOException $e)
        {
            exit('No se pudo conectar con la base de datos');
        }
        $date = Utils::BuildCurrentDate();        
    }

    protected function ExecuteQuery($queryStr, $params)
    {
        $query = $this->db->prepare($queryStr);
        if (empty($params))
        {
            $query->execute();            
        }
        else 
        {
            $query->execute($params);
        }
        return $query;        
    }   
    
    public function GetLastInsertedId()
    {
        $query = $this->db->query('SELECT LAST_INSERT_ID()');

        return $query->fetchColumn();
    }
}