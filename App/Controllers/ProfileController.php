<?php

namespace App\Controllers;

use App\Models\UsersModel;

use App\Services\ApiService;
use App\Services\SecureService;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Password;
use Core\Session;

class ProfileController extends Controller{
    
    public function __pre() {
        
        ApiService::checkAjax();
        SecureService::checkSession();
    }
    
    public function perfil_cambiar_datos()
    {
        $user_id = Session::get("USER_ID");
        
        $nombre = Request::post("nombre");
        $apellido = Request::post("apellido");
        
        $update = UsersModel::updateUser($user_id, $nombre, $apellido);
        
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
    
    public function perfil_cambiar_password()
    {
        $user_id = Session::get("USER_ID");
        
        $password_old = Request::post("password_old");
        
        $userdata = UsersModel::getUserById($user_id, true);
        
        if(!Password::verify($password_old, $userdata['password']))
        {
            return Response::json([
                'codigo' => 30
            ]); 
        }
        
        $password = Password::encrypt(Request::post("password"));
        
        $updatePass = UsersModel::updateUserPassword($user_id, $password);
        
        if(!$updatePass)
        {
            return Response::json([
                'codigo' => 20
            ]); 
        }
        
        return Response::json([
            'codigo' => 10
        ]);

    }
    
    public function perfil_info()
    {
        $user_id = Session::get("USER_ID");
                
        if(!$user_id)
        {
            return Response::json([
                'codigo' => 30
            ]);
        }
        
        $userdata = UsersModel::getUserById($user_id);
        
        if(!$userdata)
        {
            return Response::json([
                'codigo' => 20
            ]);
        }
        
        return Response::json([
            'codigo' => 10,
            'data' => $userdata
        ]);
    }
}