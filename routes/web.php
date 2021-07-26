<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->post('api/auth/login', 'AuthController@authenticate');

$router->group(['middleware' => 'auth', 'prefix' => 'api'], function () use ($router) {
    $router->get('account/{type}/{id}', 'AccountController@show');
    $router->get('type-movement/all', 'TypeMovementController@all');
    $router->get('type-account/all', 'TypeAccountController@all');
    $router->get('type-account/all2', 'TypeAccountController@all2');
    $router->get('banks/all', 'BanksController@all');
    $router->post('movement', 'MovementsController@store');
    $router->get('user/info', 'UserController@infoUser');
});
