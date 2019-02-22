<?php

namespace App\Controllers;

use Core\View;

class PublicController extends LayoutController{
    
    public function __pre(){
        
        $this->layout = "base/layout_public.php";
        
        parent::__pre();
    }
    
    public function login()
    {
        return View::make("public/login.php");
    }
    
    public function registro()
    {
         return View::make("public/registro.php");
    }
}

