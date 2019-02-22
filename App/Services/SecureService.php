<?php

namespace App\Services;

use Core\Request;
use Core\Session;

class SecureService{
    
    public static function checkLogin()
    {
        if(!self::checkSession())
        {
            Session::destroy();
            Request::location("login");
        }
        
        Session::set("LAST_TIME", time());
    }
    
    public static function checkSession()
    {
        if(!Session::exists("LOGGED"))
        {
            Session::destroy();
            return false;
        }

        if(!Session::get("REMEMBER") && (time() - Session::get("LAST_TIME") > SESSION_TIMEOUT))
        {
            Session::destroy();
            return false;
        }
        
        return true;
    }
}
