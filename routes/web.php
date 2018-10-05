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


$router->post('/api/auth/login', 'AuthController@authenticate');

$router->group(['prefix' => 'api', 'middleware' => 'jwt.auth'], function () use ($router) {
    /**
     * Routes for resource proposal
     */
    $router->get('proposal', 'ProposalsController@all');
    $router->get('proposal/{id}', 'ProposalsController@get');
    $router->post('proposal', 'ProposalsController@add');
    $router->put('proposal/{id}', 'ProposalsController@put');
    $router->delete('proposal/{id}', 'ProposalsController@remove');
    
    /**
     * Routes for resource role
     */
    $router->get('role', 'RolesController@all');
    $router->get('role/{id}', 'RolesController@get');
    $router->post('role', 'RolesController@add');
    $router->put('role/{id}', 'RolesController@put');
    $router->delete('role/{id}', 'RolesController@remove');
    
    /**
     * Routes for resource permission
     */
    $router->get('permission', 'PermissionsController@all');
    $router->get('permission/{id}', 'PermissionsController@get');
    $router->post('permission', 'PermissionsController@add');
    $router->put('permission/{id}', 'PermissionsController@put');
    $router->delete('permission/{id}', 'PermissionsController@remove');
});
