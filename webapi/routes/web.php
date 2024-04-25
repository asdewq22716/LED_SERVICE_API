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

$router->get('api/revive-001', [
    'as' => 'revive_001', 'uses' => 'ReviveController@revive_001'
]);
$router->get('api/mediate-001', [
    'as' => 'revive_001', 'uses' => 'ReviveController@mediate_001'
]);
$router->get('api/efiling-001', [
    'as' => 'revive_001', 'uses' => 'ReviveController@efiling_001'
]);
$router->get('api/insolvent-001', [
    'as' => 'revive_001', 'uses' => 'ReviveController@insolvent_001'
]);
