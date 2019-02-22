<?php

namespace App\Models;

use Core\Database;

class TasksModel{
    
    public static function getTasksByProjectId($project_id)
    {
        $fields['project_id'] = $project_id;
        
        $sql = "
            SELECT
            tasks.id as task_id,
            tasks.name,
            tasks.description,
            tasks.priority,
            tasks.status,
            users.username,
            tasks.created
            FROM tasks
            INNER JOIN projects on projects.id = tasks.project_id
            LEFT JOIN users on users.id = tasks.user_id
            WHERE tasks.project_id = :project_id
            ORDER BY tasks.created DESC";
        
        return Database::instance()->fetchAll($sql, $fields);
    }
    
    public static function getTasksByUserId($user_id)
    {
        $fields['user_id'] = $user_id;
        
        $sql = "
            SELECT
            tasks.id as task_id,
            tasks.name,
            tasks.description,
            tasks.priority,
            tasks.status,
            users.username,
            tasks.created
            FROM tasks
            INNER JOIN projects on projects.id = tasks.project_id
            LEFT JOIN users on users.id = tasks.user_id
            WHERE tasks.user_id = :user_id
            ORDER BY tasks.created DESC";
        
        return Database::instance()->fetchAll($sql, $fields);
    }
    
    public static function getTaskById($task_id)
    {
        $fields['task_id'] = $task_id;
        
        $sql = "
            SELECT
            tasks.id as task_id,
            tasks.name,
            tasks.description,
            tasks.priority,
            tasks.status,
            users.username,
            tasks.created
            FROM tasks
            LEFT JOIN users on users.id = tasks.user_id
            WHERE tasks.id = :task_id";
        
        return Database::instance()->fetch($sql, $fields);
    }
    
    public static function createTask($name, $description, $priority, $project_id)
    {
        $fields['name'] = $name;
        $fields['description'] = $description;
        $fields['priority'] = $priority;
        $fields['project_id'] = $project_id;
        
        $sql = "
            INSERT INTO
            tasks
            (name, description, priority, project_id) VALUES (:name, :description, :priority, :project_id)";
        
        $create = Database::instance()->execute($sql, $fields, true);
        
        if($create)
        {
            return Database::instance()->InsertId();
        }
        
        print_r(Database::instance()->getError());
        
        return $create;
    }
        
    public static function updateTask($task_id, $name, $description, $priority)
    {
        $fields['task_id'] = $task_id;
        $fields['name'] = $name;
        $fields['description'] = $description;
        $fields['priority'] = $priority;
                
        $sql = "
            UPDATE tasks
            SET name = :name, description = :description, priority = :priority, updated = NOW()
            WHERE id = :task_id";
        
        return Database::instance()->execute($sql, $fields);
    }
    
    public static function deleteTask($task_id)
    {
        $fields['task_id'] = $task_id;
                
        $sql = "
            DELETE FROM tasks
            WHERE id = :task_id";
        
        return Database::instance()->execute($sql, $fields);
    }
    
    public static function getAsignedTasks($user_id)
    {
        $fields['user_id'] = $user_id;
        
        $sql = "
            SELECT
            tasks.id as task_id,
            tasks.name,
            tasks.created,
            tasks.priority,
            tasks.status
            FROM projects
            WHERE tasks.user_id = :user_id
            ORDER BY tasks.created DESC";
        
        return Database::instance()->fetchAll($sql, $fields);
    }
}