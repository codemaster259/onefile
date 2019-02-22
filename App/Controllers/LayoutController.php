<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\View;

class LayoutController extends Controller{
    
    protected $layout = "base/blank.php";
    
    public function __post(){
        
        if(!Request::isAjax() && $this->layout != null)
        {
            $this->response = View::make($this->layout, ['content' => $this->response]);
        }
    }
}

