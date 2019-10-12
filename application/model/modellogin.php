<?php

class ModelLogin extends Model
{
    public function GetUser($user)
    {
        $sql = "SELECT username, password FROM users WHERE username = :user";
        $params = array(':user' => $user);
        return $this->ExecuteQuery($sql, $params)->fetch();
    }
}