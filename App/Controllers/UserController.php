<?php

namespace App\Controllers;

use App\Models\UsersModel;

use App\Services\ApiService;
use App\Services\SecureService;

use Core\Controller;
use Core\Request;
use Core\Response;

class UserController extends Controller{
    
    public function __pre()
    {
        ApiService::checkAjax();
        SecureService::checkSession();
    }
    
    public function usuarios_lista()
    {
        $username = Request::post("username");
        
        $userlist = UsersModel::searchUsersByUsername($username);
        
        return Response::json([
            'codigo' => 10,
            'data' => $userlist
        ]);
    }
}