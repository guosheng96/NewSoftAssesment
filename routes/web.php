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



// API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    $router->group(['middleware'=>'auth'], function () use ($router){

        $router->post('logout', 'AuthController@logout');
        $router->post('refresh', 'AuthController@refresh');
        $router->post('me', 'AuthController@me');

        $router->post('like', 'LikeController@like');
        $router->delete('like', 'LikeController@dislike');

        $router->get('post', 'PostController@index');
        $router->get('post/{id}', 'PostController@show');
        $router->post('post', ['uses' => 'PostController@create']);
        $router->put('post/{id}', ['uses' => 'PostController@update']);
        $router->delete('post/{id}', ['uses' => 'PostController@delete']);

        $router->post('comment', 'CommentController@comment');
    });
});

