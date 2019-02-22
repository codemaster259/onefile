<?php

namespace App\Services;

use Core\Request;

class ApiService{
    
    public static function checkAjax()
    {
        if(!Request::isAjax())
        {
            die("Must be AJAX!");
        }
    }
}
