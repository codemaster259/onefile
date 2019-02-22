<?php

namespace App\Models;

use Core\Database;

class ProjectsModel{
    
    public static function getOwnProjects($user_id)
    {
        $fields['user_id'] = $user_id;
        
        $sql = "
            SELECT
            projects.id as project_id,
            projects.name,
            users.username,
            projects.created,
            projects.priority,
            projects.status
            FROM projects
            INNER JOIN users on users.id = projects.user_id
            WHERE projects.user_id = :user_id
            ORDER BY projects.created DESC";
        
        return Database::instance()->fetchAll($sql, $fields);
    }
    
    public static function getCollaborateProjects($user_id)
    {
        $fields['user_id'] = $user_id;
        
        $sql = "
            SELECT
            projects.id as project_id,
            projects.name,
            users.username,
            projects.created,
            projects.priority,
            projects.status
            FROM projects
            INNER JOIN users on users.id = projects.user_id
            INNER JOIN tasks on tasks.project_id = users.id
            WHERE projects.user_id = :user_id
            ORDER BY projects.created DESC";
        
        return Database::instance()->fetchAll($sql, $fields);
    }
    
    public static function getProjectById($project_id)
    {
        $fields['project_id'] = $project_id;
        
        $sql = "
            SELECT
            id as project_id,
            name,
            description,
            priority,
            status,
            created
            FROM projects
            WHERE id = :project_id";
        
        return Database::instance()->fetch($sql, $fields);
    }
    
    public static function createProject($name, $description, $priority, $user_id)
    {
        $fields['name'] = $name;
        $fields['description'] = $description;
        $fields['priority'] = $priority;
        $fields['user_id'] = $user_id;
        
        $sql = "
            INSERT INTO
            projects
            (name, description, priority, user_id) VALUES (:name, :description, :priority, :user_id)";
        
        $create = Database::instance()->execute($sql, $fields, true);
        
        if($create)
        {
            return Database::instance()->InsertId();
        }
        
        return false;
    }
        
    public static function updateProject($project_id, $name, $description, $priority)
    {
        $fields['project_id'] = $project_id;
        $fields['name'] = $name;
        $fields['description'] = $description;
        $fields['priority'] = $priority;
                
        $sql = "
            UPDATE projects
            SET name = :name, description = :description, priority = :priority, updated = NOW()
            WHERE id = :project_id";
        
        return Database::instance()->execute($sql, $fields);
    }
    
    public static function deleteProject($project_id)
    {
        $fields['project_id'] = $project_id;
                
        $sql = "
            DELETE FROM projects
            WHERE id = :project_id";
        
        return Database::instance()->execute($sql, $fields);
    }
}