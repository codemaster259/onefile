<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\ProjectsModel;
use App\Models\TasksModel;

use App\Services\SecureService;

use Core\Request;
use Core\Session;
use Core\View;

class PanelController extends LayoutController{
       
    public function __pre(){
        
        SecureService::checkLogin();
        
        $this->layout = "base/layout_panel.php";
    }
    
    public function index()
    {
        return View::make("panel/home/index.php");
    }
    
    public function inicio()
    {
        $user_id = Session::get("USER_ID");
        
        $data['proyectos'] = ProjectsModel::getOwnProjects($user_id);
        
        $data['tareas'] = TasksModel::getTasksByUserId($user_id);
        
        return View::make("panel/index/index.php", $data);
    }
    
    public function administrar()
    {
        $project_id = Request::query("project_id");
        
        if($project_id)
        {
            return $this->administrar_tareas();
        }else{
            return $this->administrar_proyectos();
        }
    }
    
    public function administrar_proyectos()
    {
        
        return  View::make("panel/manager/projects.php");
    }
    
    public function administrar_tareas()
    {
        $data['project_id'] = Request::query("project_id");
        
        return  View::make("panel/manager/tasks.php", $data);
    }
    
    public function tareas()
    {
        return View::make("panel/tasker/index.php");
    }
    
    public function perfil()
    {
        $user_id = Session::get("USER_ID");
        
        $userdata = UsersModel::getUserById($user_id);
        
        return View::make("panel/profile/index.php", $userdata);
    }
}

