<?php

class ModelPosts extends Model
{
    public function SavePost($id, $title, $body)
    {
        $date = Utils::BuildCurrentDate();
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
        $sql = "SELECT id, title, body, date FROM posts WHERE id = :id";
        $params = array(':id' => $id);
        return $this->ExecuteQuery($sql, $params)->fetch();
    }

    public function GetPostList()
    {
        $sql = "SELECT id, title, body, date FROM posts ORDER BY date DESC";
        return $this->ExecuteQuery($sql, null)->fetchAll();
    }

    public function DeletePost($id)
    {        
        $sql = "DELETE FROM posts WHERE id = :id";
        $params = array(':id' => $id);
        return $this->ExecuteQuery($sql, $params);
    }   
}