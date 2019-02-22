<?php

error_reporting(E_ALL);
//define current root and directory separator
define("CORE_ROOT", dirname(__DIR__)."/");

//require framework
require_once CORE_ROOT."Core/OneFileFW.php";

//register autoload
Core\FileSystem::setRoot(CORE_ROOT);
Core\FileSystem::autoload();

use Core\Commander;
use Core\FileSystem;
use Core\Env;

//load env.ini file
Env::fromINI(CORE_ROOT."env.ini");

Commander::addCommand("hello:world", function($args = []){
    print_r("Hello World!");
    print_r($args);
});

Commander::addCommand("view:create", function($args = []){
    
    $name = array_shift($args);
    
    if(!$name)
    {
        print_r("Write a view name");
    }
    
    $path = "App/Views/";
    
    $file = $path.$name.".php";
    
    if(file_exists($file))
    {
        if(!in_array("-o", $args))
        {
            print_r("File {$name} exists!");
            die();
        }
    }
    
    $data = [
        "{{file}}" =>  $file
    ];

    $temp = "Core/Templates/view.txt";

    $content = FileSystem::read($temp, function($str) use ($data){
        return str_replace(array_keys($data), array_values($data), $str);
    });
    
    if(FileSystem::writeFile($file, $content))
    {
        print_r("View {$name} created!");
    }else{
        print_r("View {$name} can't be created!");
    }
});

Commander::addCommand("controller:create", function($args = []){
        
    $name = array_shift($args);
    
    if(!$name)
    {
        print_r("Write a controller name");
    }

    $name = ucwords(strtolower($name));
    
    $path = "App/Controllers/";
    
    $file = $path.$name."Controller.php";
    
    if(file_exists($file))
    {
        if(!in_array("-o", $args))
        {
            print_r("File {$name} exists!");
            die();
        }
    }

    $data = [
        "{{name}}" =>  $name
    ];

    $temp = "Core/Templates/controller.txt";

    $content = FileSystem::read($temp, function($str) use ($data){
        return str_replace(array_keys($data), array_values($data), $str);
    });
    
    if(FileSystem::writeFile($file, $content))
    {
        print_r("Controller {$name} created!");
    }else{
        print_r("Controller {$name} can't be created!");
    }
});

Commander::addCommand("model:create", function($args = []){
        
    $name = array_shift($args);
    
    if(!$name)
    {
        print_r("Write a model name");
    }

    $name = ucwords(strtolower($name));
    
    $path = "App/Models/";
    
    $file = $path.$name."Models.php";
    
    if(file_exists($file))
    {
        if(!in_array("-o", $args))
        {
            print_r("File {$name} exists!");
            die();
        }
    }

    $data = [
        "{{name}}" =>  $name
    ];

    $temp = "Core/Templates/model.txt";

    $content = FileSystem::read($temp, function($str) use ($data){
        return str_replace(array_keys($data), array_values($data), $str);
    });
    
    if(FileSystem::writeFile($file, $content))
    {
        print_r("File {$name} created!");
    }else{
        print_r("File {$name} can't be created!");
    }
});

Commander::run($argv);