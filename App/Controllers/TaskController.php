<?php

namespace App\Controllers;

use App\Models\TasksModel;

use App\Services\ApiService;
use App\Services\SecureService;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Session;

class TaskController extends Controller{
    
    public function __pre()
    {
        ApiService::checkAjax();
        SecureService::checkSession();
    }
    
    public function tareas_lista()
    {
        $user_id = Session::get("USER_ID");
        $project_id = Request::post("project_id");
        
        $tareas = TasksModel::getTasksByProjectId($project_id);
        
        return Response::json([
            'codigo' => 10,
            'data' => $tareas
        ]);
    }
    
    public function tareas_usuario()
    {
        $user_id = Session::get("USER_ID");
        
        $tareas = TasksModel::getTasksByUserId($user_id);
        
        return Response::json([
            'codigo' => 10,
            'data' => $tareas
        ]);
    }
    
    public function tareas_agregar()
    {
        $name = Request::post("name");
        $desc = Request::post("description");
        $prior = Request::post("priority");
        $project_id = Request::post("project_id");
        
        $result = TasksModel::createTask($name, $desc, $prior, $project_id);
                
        if(!$result)
        {
            return Response::json([
                'codigo' => 20
            ]);
        }
        
        return Response::json([
            'codigo' => 10
        ]);
    }
    
    public function tareas_editar()
    {
        $id = Request::post("task_id");
        
        $task = TasksModel::getTaskById($id);
        
        if(!$task)
        {
            return Response::json([
                'codigo' => 20
            ]);
        }
        
        return Response::json([
            'codigo' => 10,
            'data' => $task
        ]);
    }
    
    public function tareas_actualizar()
    {
        $id = Request::post("task_id");
        $name = Request::post("name");
        $desc = Request::post("description");
        $prior = Request::post("priority");
        
        $update = TasksModel::updateTask($id, $name, $desc, $prior);
        
        if(!$update)
        {
            return Response::json([
                'codigo' => 20
            ]);
        }
        
        return Response::json([
            'codigo' => 10
        ]);
    }
    
    public function tareas_eliminar()
    {
        $id = Request::post("task_id");
        
        $delete = TasksModel::deleteTask($id);
                
        if(!$delete)
        {
            return Response::json([
                'codigo' => 20
            ]);
        }
        
        return Response::json([
            'codigo' => 10
        ]);
    }
    
    public function tareas_usuario_asignar()
    {
        
    }
}

