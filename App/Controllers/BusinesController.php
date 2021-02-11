<?php

namespace App\Controllers;

use Core\Controller;
use Core\Response;

class BusinesController extends Controller{
    
    public function inicio()
    {
        return view("panel/negocio/index.php", ['nombre' => 'samuel']);
    }

    public function test()
    {
        return Response::text("test");
    }
}