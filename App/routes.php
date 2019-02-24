<?php

use Core\Captcha;
use Core\Request;
use Core\Response;
use Core\Route;
use Core\Session;
use Core\Times;

//filters

define("SESSION_TIMEOUT", 30 * Times::Minutes);

Route::filter("ajax", function($url){

    return Request::isAjax();

}, function(){

    return Response::html("Filter: Must be AJAX!");
});

Route::filter("auth", function($url){
   
    if(!Session::exists("LOGGED"))
    {
        Session::destroy();
        if(!Request::isAjax())
        {
            Request::location("login");
        }
        return false;
    }

    if(!Session::get("REMEMBER") && (time() - Session::get("LAST_TIME") > SESSION_TIMEOUT))
    {
        Session::destroy();
        if(!Request::isAjax())
        {
            Request::location("login");
        }
        return false;
    }
    
    return true;

}, function(){

    return Response::json(["Filter" => "Session Expired!"]);
});

//Routes

Route::add("/hello/{name:any}*", function(){
    debug(Request::param());
    $name = Request::param("name", "guest");
    return Response::html("Hello {$name}!");
});
//*/

Route::add("/captcha", function(){
    $captcha = Captcha::generate();
    //header("X-Captcha-Value: {$captcha}");
    Session::set("captcha", $captcha);
    Captcha::printImage($captcha);
});


/*VIEWS*/
//login
Route::add("/login", 'App\Controllers\PublicController@login');

//registro
if(env("APP.allowRegister", false))
{
    Route::add("/registro", 'App\Controllers\PublicController@registro');
}

//panel
Route::add("/", 'App\Controllers\PanelController@index', ["auth"]);
Route::add("/inicio", 'App\Controllers\PanelController@inicio', ["auth"]);
Route::add("/administrar", 'App\Controllers\PanelController@administrar', ["auth"]);
Route::add("/tareas", 'App\Controllers\PanelController@tareas', ["auth"]);
Route::add("/perfil", 'App\Controllers\PanelController@perfil', ["auth"]);


/*API*/
//registro
if(env("APP.allowRegister", false))
{
    Route::add("/registrar_usuario", 'App\Controllers\AuthController@registrar_usuario');
}

//auth
Route::add("/login_usuario", 'App\Controllers\AuthController@login_usuario');
Route::add("/logout", 'App\Controllers\AuthController@logout');

//usuarios
Route::add("/usuarios_lista", 'App\Controllers\UserController@usuarios_lista', ["auth", "ajax"]);

//perfil
Route::add("/perfil_info", 'App\Controllers\ProfileController@perfil_info', ["auth", "ajax"]);
Route::add("/perfil_cambiar_datos", 'App\Controllers\ProfileController@perfil_cambiar_datos', ["auth", "ajax"]);
Route::add("/perfil_cambiar_password", 'App\Controllers\ProfileController@perfil_cambiar_password', ["auth", "ajax"]);

//proyectos
Route::add("/proyectos_lista", 'App\Controllers\ProjectController@proyectos_lista', ["auth", "ajax"]);
Route::add("/proyectos_agregar", 'App\Controllers\ProjectController@proyectos_agregar', ["auth", "ajax"]);
Route::add("/proyectos_editar", 'App\Controllers\ProjectController@proyectos_editar', ["auth", "ajax"]);
Route::add("/proyectos_actualizar", 'App\Controllers\ProjectController@proyectos_actualizar', ["auth", "ajax"]);
Route::add("/proyectos_eliminar", 'App\Controllers\ProjectController@proyectos_eliminar', ["auth", "ajax"]);

//tareas
Route::add("/tareas_lista", 'App\Controllers\TaskController@tareas_lista', ["auth", "ajax"]);
Route::add("/tareas_agregar", 'App\Controllers\TaskController@tareas_agregar', ["auth", "ajax"]);
Route::add("/tareas_editar", 'App\Controllers\TaskController@tareas_editar', ["auth", "ajax"]);
Route::add("/tareas_actualizar", 'App\Controllers\TaskController@tareas_actualizar', ["auth", "ajax"]);
Route::add("/tareas_eliminar", 'App\Controllers\TaskController@tareas_eliminar', ["auth", "ajax"]);
Route::add("/tareas_usuario", 'App\Controllers\TaskController@tareas_usuario', ["auth", "ajax"]);
Route::add("/tareas_usuario_asignar", 'App\Controllers\TaskController@tareas_usuario_asignar', ["auth", "ajax"]);