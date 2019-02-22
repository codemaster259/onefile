<?php

namespace App\Controllers;

use App\Models\ProjectsModel;

use App\Services\ApiService;
use App\Services\SecureService;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Session;

class ProjectController extends Controller{
    
    public function __pre()
    {
        ApiService::checkAjax();
        SecureService::checkSession();
    }
    
    public function proyectos_lista()
    {
        $user_id = Session::get("USER_ID");
        $type = Request::post("type");
        
        $proyectos = [];
        
        if($type == 1)
        {
            $proyectos = ProjectsModel::getOwnProjects($user_id);
        }
        if($type == 2)
        {
            $proyectos = ProjectsModel::getCollaborateProjects($user_id);
        }
        
        return Response::json([
            'codigo' => 10,
            'data' => $proyectos
        ]);
    }
    
    public function proyectos_agregar()
    {
        $user_id = Session::get("USER_ID");
        $name = Request::post("name");
        $desc = Request::post("description");
        $prior = Request::post("priority");
        
        $result = ProjectsModel::createProject($name, $desc, $prior, $user_id);
        
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
    
    public function proyectos_editar()
    {
        $user_id = Session::get("USER_ID");
        $id = Request::post("project_id");
        
        $proyecto = ProjectsModel::getProjectById($id);
        
        if(!$proyecto)
        {
            return Response::json([
                'codigo' => 20
            ]);
        }
        
        return Response::json([
            'codigo' => 10,
            'data' => $proyecto
        ]);
    }
    
    public function proyectos_actualizar()
    {
        $id = Request::post("project_id");
        $name = Request::post("name");
        $desc = Request::post("description");
        $prior = Request::post("priority");
        
        $update = ProjectsModel::updateProject($id, $name, $desc, $prior);
        
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
    
    public function proyectos_eliminar()
    {
        $id = Request::post("project_id");
        
        $delete = ProjectsModel::deleteProject($id);
                
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
}

