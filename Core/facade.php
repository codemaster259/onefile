<?php

use Core\Block;
use Core\Env;
use Core\Helper;
use Core\Session;
use Core\View;


/**
 * Fachada para Env::get()
 * 
 * @param string $key
 * @param mixed $def
 * @return mixed
 */
function env($key, $def = null)
{
    return Env::get($key, $def);
}

function view($_path, $_data = []){
    
    return View::make($_path, $_data);
}

function session_get($key, $def = null){
    
    return Session::get($key, $def);
}

function is_INT_MAX($val)
{
    return $val == PHP_INT_MAX;
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