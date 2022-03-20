<?php

class ModelPosts extends Model
{
    public function SavePost($id, $title, $slug, $body, $published)
    {
        $date = Utils::BuildCurrentDate();
        $params = array(':title' => $title, ':body' => $body, ':slug' => $slug, ':date' => $date, ':published' => $published);
        if ($id == 0)
        {
            $sql = "INSERT INTO posts (title, slug, body, date, published) VALUES (:title, :slug, :body, :date, :published)";            
        }
        else 
        {
            $sql = "UPDATE posts SET title = :title, slug = :slug, body = :body, date = :date, published = :published WHERE id = :id";
            $params[':id'] = $id;
        }
        return $this->ExecuteQuery($sql, $params);
    }
    
    public function GetPost($id)
    {       
        $sql = "SELECT id, title, slug, body, date, published FROM posts WHERE id = :id";
        $params = array(':id' => $id);
        return $this->ExecuteQuery($sql, $params)->fetch();
    }

    public function GetPostBySlug($slug)
    {
        $sql = "SELECT id, title, slug, body, date, published FROM posts WHERE slug = :slug";
        $params = array(':slug' => $slug);
        return $this->ExecuteQuery($sql, $params)->fetch();
    }

    public function GetPostList()
    {
        $sql = "SELECT id, title, slug, body, date, published FROM posts ORDER BY date DESC";
        return $this->ExecuteQuery($sql, null)->fetchAll();
    }

    public function GetPublicPostList()
    {
        $sql = "SELECT id, title, slug, body, date FROM posts WHERE published = '1' ORDER BY date DESC";
        return $this->ExecuteQuery($sql, null)->fetchAll();
    }

    public function DeletePost($id)
    {        
        $sql = "DELETE FROM posts WHERE id = :id";
        $params = array(':id' => $id);
        return $this->ExecuteQuery($sql, $params);
    }   
}