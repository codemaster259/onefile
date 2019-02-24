<?php

use Core\Block;
use Core\Env as EnvClass;
use Core\Helper;
use Core\Session;
use Core\View as ViewClass;
use Core\FileSystem;


/**
 * Fachada para Env::get()
 * 
 * @param string $key
 * @param mixed $def
 * @return mixed
 */
function env($key, $def = null)
{
    return EnvClass::get($key, $def);
}

function view($_path, $_data = [])
{
    return ViewClass::make($_path, $_data);
}

function session_get($key, $def = null)
{
    return Session::get($key, $def);
}

function session_exists($key)
{
    return Session::exists($key);
}

function block_open($name)
{
    Block::open($name);
}

function block_close($name)
{
    return Block::close($name);
}

function block_get($name)
{
    return Block::get($name);
}

function debug($data)
{
    Helper::debug($data);
}

/*
function import($stringClass)
{
    $className = "\\".str_replace(".", "\\", $stringClass);

    if(!class_exists($className))
    {
        FileSystem::autoload($className);
    }
}

/*

//USAGE:
import("App.Services.ApiService");

echo ApiService::class;
//*/