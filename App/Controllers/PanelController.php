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
    
    public function inicio()
    {
        return View::make("panel/home/index.php");
    }
    
    public function perfil()
    {
        $user_id = Session::get("USER_ID");
        
        $userdata = UsersModel::getUserById($user_id);
        
        return View::make("panel/profile/index.php", $userdata);
    }
}

