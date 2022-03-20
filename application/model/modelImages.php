<?php

class ModelImages extends Model
{
    public function SaveImage($id, $name, $fileName)
    {
        $params = array(':name' => $name, ':fileName' => $fileName);
        if ($id == 0)
        {
            $sql = "INSERT INTO images (name, filename) VALUES (:name, :fileName)";
        }
        else 
        {
            $sql = "UPDATE images SET name = :name, filename = :fileName WHERE id = :id";
            $params[':id'] = $id;
        }
        return $this->ExecuteQuery($sql, $params);
    }

    public function GetImageList()
    {
        $sql = "SELECT id, name, filename FROM images ORDER BY name";
        return $this->ExecuteQuery($sql, null)->fetchAll();
    }

    public function GetImage($id)
    {
        $sql = "SELECT id, name, filename FROM images WHERE id = :id";
        $params = array(':id' => $id);
        return $this->ExecuteQuery($sql, $params)->fetch();
    }

    public function DeleteImage($id)
    {
       $sql = "DELETE FROM images WHERE id = :id";
       $params = array(':id' => $id);
       return $this->ExecuteQuery($sql, $params);
    }  
    
    public function SavePostImages($postid, $imageArray)
    {
        // First, delete all images of this post
        $sql = "DELETE FROM postimages WHERE idpost = :postid";
        $params = array(':postid' => $postid);
        $this->ExecuteQuery($sql, $params);

        // Iterate through all images to save them       
        $sql = "INSERT INTO postimages (idpost, idimage) VALUES (:postid, :idimage)";
        foreach($imageArray as $idimage)
        {
            $params[':idimage'] = $idimage;
            $this->ExecuteQuery($sql, $params);
        }
    }

    public function GetImagesByPost($id)
    {
        $sql = "SELECT idpost, idimage, name, filename FROM imagesbypost WHERE idpost =:idPost ORDER BY name";
        $params = array(':idPost' => $id);
        return $this->ExecuteQuery($sql, $params)->fetch();
    }
}