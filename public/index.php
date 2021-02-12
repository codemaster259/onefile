<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../Core/autoload.php";

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
Env::fromINI("env.ini");

//set default timezone
date_default_timezone_set(env("App.timezone", "America/Caracas"));

FileSystem::requireFile("App/Config/routes.php");

echo Route::match(PATH_INFO);

if(Request::isAjax()){die();}

