<?php

use Core\Captcha;
use Core\Request;
use Core\Response;
use Core\Route;
use Core\Session;
use Core\Times;

//filters

define("SESSION_TIMEOUT", 30 * Times::Minutes);

Route::filter("ajax", function(){

    return Request::isAjax();

}, function(){

    return Response::html("Filter: Must be AJAX!");
});

Route::filter("auth", function(){
   
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
Route::add("/", 'App\Controllers\PanelController@inicio', ["auth"]);
Route::add("/inicio", 'App\Controllers\PanelController@inicio', ["auth"]);
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


//perfil
Route::add("/perfil_info", 'App\Controllers\ProfileController@perfil_info', ["auth", "ajax"]);
Route::add("/perfil_cambiar_datos", 'App\Controllers\ProfileController@perfil_cambiar_datos', ["auth", "ajax"]);
Route::add("/perfil_cambiar_password", 'App\Controllers\ProfileController@perfil_cambiar_password', ["auth", "ajax"]);