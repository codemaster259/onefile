<?php

use Core\Route;
use Core\Times;

define("SESSION_TIMEOUT", 30 * Times::Minutes);

//Routes

/*
Route::add("/hello/{name}*", function(){
    print_r(Core\Request::param());
    $name = Core\Request::param("name", "guest");
    return Core\Response::html("Hello {$name}!");
});
*/

Route::add("/captcha", function(){
    $captcha = \Core\Captcha::generate();
    //header("X-Captcha-Value: {$captcha}");
    \Core\Session::set("captcha", $captcha);
    \Core\Captcha::printImage($captcha);
});

/*STATIC*/
//public
Route::add("/login", 'App\Controllers\PublicController@login');
Route::add("/registro", 'App\Controllers\PublicController@registro');

//panel
Route::add("/", 'App\Controllers\PanelController@index');
Route::add("/inicio", 'App\Controllers\PanelController@inicio');
Route::add("/administrar", 'App\Controllers\PanelController@administrar');
Route::add("/tareas", 'App\Controllers\PanelController@tareas');
Route::add("/perfil", 'App\Controllers\PanelController@perfil');


/*API*/
//auth
Route::add("/registrar_usuario", 'App\Controllers\AuthController@registrar_usuario');
Route::add("/login_usuario", 'App\Controllers\AuthController@login_usuario');
Route::add("/logout", 'App\Controllers\AuthController@logout');

//usuarios
Route::add("/usuarios_lista", 'App\Controllers\UserController@usuarios_lista');

//perfil
Route::add("/perfil_info", 'App\Controllers\ProfileController@perfil_info');
Route::add("/perfil_cambiar_datos", 'App\Controllers\ProfileController@perfil_cambiar_datos');
Route::add("/perfil_cambiar_password", 'App\Controllers\ProfileController@perfil_cambiar_password');

//proyectos
Route::add("/proyectos_lista", 'App\Controllers\ProjectController@proyectos_lista');
Route::add("/proyectos_agregar", 'App\Controllers\ProjectController@proyectos_agregar');
Route::add("/proyectos_editar", 'App\Controllers\ProjectController@proyectos_editar');
Route::add("/proyectos_actualizar", 'App\Controllers\ProjectController@proyectos_actualizar');
Route::add("/proyectos_eliminar", 'App\Controllers\ProjectController@proyectos_eliminar');

//tareas
Route::add("/tareas_lista", 'App\Controllers\TaskController@tareas_lista');
Route::add("/tareas_agregar", 'App\Controllers\TaskController@tareas_agregar');
Route::add("/tareas_editar", 'App\Controllers\TaskController@tareas_editar');
Route::add("/tareas_actualizar", 'App\Controllers\TaskController@tareas_actualizar');
Route::add("/tareas_eliminar", 'App\Controllers\TaskController@tareas_eliminar');
Route::add("/tareas_usuario", 'App\Controllers\TaskController@tareas_usuario');
Route::add("/tareas_usuario_asignar", 'App\Controllers\TaskController@tareas_usuario_asignar');