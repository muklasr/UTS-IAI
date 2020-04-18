<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post(
    'login', 
    [
       'uses' => 'AuthController@authenticate'
    ]
);
$router->post('register', 'UserController@register');

$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router) {
        $router->get('profile', 'UserController@getCurrentUser');
        $router->put('profile', 'UserController@update');
        $router->delete('user/{id}', 'UserController@destroy');
        
        $router->post('sosmed', 'MediaSocialController@store');
        $router->get('sosmed', 'MediaSocialController@show');
        $router->put('sosmed/{id}', 'MediaSocialController@update');
        $router->delete('sosmed/{id}', 'MediaSocialController@destroy');
    }
);
