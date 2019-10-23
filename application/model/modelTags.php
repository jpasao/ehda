<?php

class ModelTags extends Model
{
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
}