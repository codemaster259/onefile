<?php

namespace App\Models;

use Core\Database;

class UsersModel{
    
    public static function searchUsersByUsername($username)
    {
        $fields['search'] = "%$username%";
        
        $sql = "
            SELECT
            id as user_id,
            username,
            name,
            status
            FROM users
            WHERE status = 1
            AND (username LIKE :search OR name LIKE :search)
            ORDER BY username ASC
            ";
        
        return Database::instance()->fetchAll($sql, $fields);
    }
    
    public static function getUserByUsername($username, $withPassword = false)
    {
        $fields['username'] = $username;
        
        $sql = "
            SELECT
            *,
            id as user_id
            FROM users
            WHERE username = :username
            ";
        
        $data = Database::instance()->fetch($sql, $fields);
        
        if(!$withPassword)
        {
            unset($data['password']);
        }
        
        return $data;
    }
    
    public static function getUserById($user_id, $withPassword = false)
    {
        $fields['user_id'] = $user_id;
        
        $sql = "
            SELECT
            *,
            id as user_id
            FROM users
            WHERE id = :user_id
            ";
        
        $data = Database::instance()->fetch($sql, $fields);
        
        if(!$withPassword)
        {
            unset($data['password']);
        }
        
        return $data;
    }
    
    public static function createUser($username, $password)
    {
        $fields['username'] = $username;
        $fields['password'] = $password;
        
        $sql = "
            INSERT INTO
            users
            (username, password) VALUES (:username, :password)";
        
        $create = Database::instance()->execute($sql, $fields, true);
        
        if($create)
        {
            return Database::instance()->InsertId();
        }
        
        return false;
    }
    
    public static function updateUser($user_id, $name, $lastname)
    {
        $fields['user_id'] = $user_id;
        $fields['name'] = $name;
        $fields['lastname'] = $lastname;
                
        $sql = "
            UPDATE users
            SET name = :name, lastname = :lastname, updated = NOW()
            WHERE id = :user_id";
        
        return Database::instance()->execute($sql, $fields);
    }
    
    public static function updateUserPassword($user_id, $password)
    {
        $fields['user_id'] = $user_id;
        $fields['password'] = $password;
                
        $sql = "
            UPDATE users
            SET password = :password, updated = NOW()
            WHERE id = :user_id";
        
        return Database::instance()->execute($sql, $fields);
    }
}