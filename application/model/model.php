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

    /******************POSTS*******************/
    public function SavePost($id, $title, $body)
    {
        $params = array(':title' => $title, ':body' => $body, ':date' => $date);
        if ($id == 0)
        {
            $sql = "INSERT INTO posts (title, body, date) VALUES (:title, :body, :date)";            
        }
        else 
        {
            $sql = "UPDATE posts SET title = :title, body = :body, date = :date WHERE id = :id";
            $params[':id'] = $id;
        }
        return $this->ExecuteQuery($sql, $params);
    }
    
    public function GetPost($id)
    {       
        $sql = "SELECT title, body, date FROM posts WHERE id = :id";
        $params = array(':id' => $id);
        return $this->ExecuteQuery($sql, $params)->fetch();
    }

    public function GetPostList()
    {
        $sql = "SELECT title, body, date FROM posts ORDER BY date DESC";
        return $this->ExecuteQuery(null, $sql)->fetchAll();
    }

    public function DeletePost($id)
    {        
        $sql = "DELETE FROM posts WHERE id = :id";
        $params = array(':id' => $id);
        return $this->ExecuteQuery($sql, $params);
    }

    /******************TAGS*******************/
    public function SaveTag($id, $name)
    {
        $params = array(':name' => $name);
        if ($id = 0) 
        {
            $sql = "INSERT INTO tags (name) VALUES (:name)";
        }
        else 
        {
            $sql = "UPDATE tags SET name = :name WHERE id = :id";
            $params[':id'] = $id;
        }
        return $this->ExecuteQuery($sql, $params);
    }

    public function SavePostTags($postid, $tagids)
    {
        // First, delete all tags of this post
        $sql = "DELETE FROM posttags WHERE id = :postid";
        $params = array(':postid' => $postid);
        $this->ExecuteQuery($sql, $params);

        // Iterate through all tags to save them
        $tagArray = explode(';', $tagids);
        $sql = "INSERT INTO posttags (idpost, idtag) VALUES (:idpost, :idtag)";
        foreach($tagArray as $idtag)
        {
            $params[':idtag'] = $idtag;
            $this->ExecuteQuery($sql, $params);
        }
    }

    public function GetTag($id)
    {
        $sql = "SELECT name FROM tags WHERE id = :id";
        $params = array(':id' => $id);
        return $this->ExecuteQuery($sql, $params)->fetch();
    }

    public function GetTagList()
    {
        $sql = "SELECT name FROM tags ORDER BY name";
        return $this->ExecuteQuery(null, $sql)->fetchAll();
    }

    public function GetTagsByPost($id)
    {
        $sql = "SELECT name FROM tags  WHERE id = :id ORDER BY name";
        $params = array(':id' => $id);
        return $this->ExecuteQuery($params, $sql)->fetch();
    }

    public function DeleteTag($id)
    {
        $sql = "DELETE FROM tags WHERE id = :id";
        $params = array(':id' => $id); 
        return $this->ExecuteQuery($sql, $params);
    }

    /******************USERS*******************/

}