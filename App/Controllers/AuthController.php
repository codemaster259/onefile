<?php

namespace App\Controllers;

use App\Models\UsersModel;

use Core\Controller;
use Core\Password;
use Core\Request;
use Core\Response;
use Core\Session;

class AuthController extends Controller{
    
    public function login_usuario()
    {
        $username = Request::post("username");
        $password = Request::post("password");
        $remember = Request::post("remember", false);
        $captcha = Request::post("captcha");
                
        $find_user = UsersModel::getUserByUsername($username, true);
        
        if(Session::get("captcha") != $captcha)
        {
            return Response::json([
                'codigo' => 50
            ]);
        }
        
        if(!$find_user)
        {
            return Response::json([
                'codigo' => 20
            ]);
        }
        
        if($find_user['status'] == 0)
        {
            return Response::json([
                'codigo' => 40
            ]);
        }
        
        if(!Password::verify($password, $find_user['password']))
        {
            return Response::json([
                'codigo' => 30
            ]);
        }
        
        Session::set("LOGGED", true);
        Session::set("USER_ID", $find_user['user_id']);
        Session::set("LAST_TIME", time());
        Session::set("REMEMBER", $remember ? true : false);
        
        return Response::json([
            'codigo' => 10
        ]);
    }
    
    public function registrar_usuario()
    {
        $username = Request::post("username");
        $password = Password::encrypt(Request::post("password"));
        $autologin = Request::post("autologin", false);
                        
        $find_user = UsersModel::getUserByUsername($username);
        
        if($find_user)
        {
            return Response::json([
                'codigo' => 20
            ]);
        }
        
        $create = UsersModel::createUser($username, $password);
        
        if(!$create)
        {
            return Response::json([
                'codigo' => 30
            ]);
        }
        
        if($autologin)
        {
            Session::set("LOGGED", true);
            Session::set("USER_ID", $create);
        }
        
        return Response::json([
            'codigo' => 10
        ]);
    }
    
    public function logout()
    {
        Session::clear();
        Request::location("login");
    }
}