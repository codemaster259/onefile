<?php

error_reporting(E_ALL);
//define current root and directory separator
define("CORE_ROOT", dirname(__DIR__)."/");

//require framework
require_once CORE_ROOT."Core/OneFileFW.php";

//register autoload
Core\FileSystem::setRoot(CORE_ROOT);
Core\FileSystem::autoload();

use Core\FileSystem;
use Core\Helper;
use Core\Session;
use Core\Env;
use Core\Route;
use Core\Request;

//start session
Session::start();

//define 
define('HTTP_ROOT', Helper::HTTP_ROOT());
define("PATH_INFO", Helper::PATH_INFO());
define("CURRENT_URL", Helper::CURRENT_URL());

//load env.ini file
Env::fromINI(CORE_ROOT."env.ini");

//set default timezone
date_default_timezone_set(env("APP.timezone", "America/Caracas"));

FileSystem::requireFile("App/routes.php");

echo Route::match(PATH_INFO);

if(Request::isAjax()){die();}

//debug(Env::get());
//echo PATH_INFO;