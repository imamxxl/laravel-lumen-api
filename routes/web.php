<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Str;

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

// membuat api route prefix /api
$router->group(["prefix" => 'api'], function() use ($router) {
    $router->get('todo', 'TodoController@index');
    $router->post('todo', 'TodoController@store');
    $router->get('todo/{id}', 'TodoController@show');
    $router->put('todo/{id}', 'TodoController@update');
    $router->delete('todo/{id}', 'TodoController@destroy');
});

// untuk generate key pada laravel lumen
$router->get('/key', function() {
    return Str::random(32);
});
