<?php

class ModelTags extends Model
{
    public function SaveTag($id, $name)
    {
        $params = array(':name' => $name);
        if ($id == 0) 
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

    public function SavePostTags($postid, $tagArray)
    {
        // First, delete all tags of this post
        $sql = "DELETE FROM posttags WHERE idpost = :postid";
        $params = array(':postid' => $postid);
        $this->ExecuteQuery($sql, $params);

        // Iterate through all tags to save them       
        $sql = "INSERT INTO posttags (idpost, idtag) VALUES (:postid, :idtag)";
        foreach($tagArray as $idtag)
        {
            $params[':idtag'] = $idtag;
            $this->ExecuteQuery($sql, $params);
        }
    }

    public function GetTag($id)
    {
        $sql = "SELECT id, name FROM tags WHERE id = :id";
        $params = array(':id' => $id);
        return $this->ExecuteQuery($sql, $params)->fetch();
    }

    public function GetTagList()
    {
        $sql = "SELECT id, name FROM tags ORDER BY name";
        return $this->ExecuteQuery($sql, null)->fetchAll();
    }

    public function GetTagsByPost($id)
    {        
        $sql = "SELECT idpost, idtag, name FROM tagsbypost WHERE idpost = :idPost ORDER BY name";
        $params = array(':idPost' => $id);
        return $this->ExecuteQuery($sql, $params)->fetchAll();
    }

    public function DeleteTag($id)
    {
        $sql = "DELETE FROM tags WHERE id = :id";
        $params = array(':id' => $id); 
        return $this->ExecuteQuery($sql, $params);
    }    
}