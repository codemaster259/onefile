<?php

error_reporting(E_ALL);

//define current root
define("CORE_ROOT", dirname(__DIR__)."/");

/*
//for composer
require_once CORE_ROOT."vendor/autoload.php";
die();
//*/

//require framework
require_once CORE_ROOT."Core/OneFileFW.php";


//register autoload
Core\FileSystem::setRoot(CORE_ROOT);
Core\FileSystem::autoload();