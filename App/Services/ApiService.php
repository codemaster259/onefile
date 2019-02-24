<?php

namespace App\Services;

use Core\Request;

class ApiService{
    
    public static function checkAjax()
    {
        return 0;
        if(!Request::isAjax())
        {
            die("Must be AJAX!");
        }
    }
}
