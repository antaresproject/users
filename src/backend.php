<?php

/**
 * Part of the Antares package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Antares Core
 * @version    0.9.0
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */
use Illuminate\Routing\Router;

/* @var $router Router */

$router->group(['prefix' => 'account'], function (Router $router) {
    $router->get('/', 'Account\ProfileUpdaterController@edit');
    $router->post('/', 'Account\ProfileUpdaterController@update');
    $router->get('password', 'Account\PasswordUpdaterController@edit');
    $router->post('password', 'Account\PasswordUpdaterController@update');
    $router->post('picture', 'UsersController@picture');
    $router->get('gravatar', 'UsersController@gravatar');
});





$router->match(['GET', 'POST'], 'users/index', '\Antares\Users\Http\Controllers\UsersController@index');
$router->get('users/elements', '\Antares\Users\Http\Controllers\UsersController@elements');
$router->post('users/delete', '\Antares\Users\Http\Controllers\UsersController@delete');
$router->match(['GET', 'POST'], 'users/{id}/status', '\Antares\Users\Http\Controllers\UsersController@status');
$router->match(['GET', 'POST'], 'users/status', '\Antares\Users\Http\Controllers\UsersController@status');


$router->resource('users', 'UsersController');
$router->match(['GET', 'HEAD'], 'items', 'UsersController@items');


$router->get('login/with/{id}', '\Antares\Users\Http\Controllers\LoginAs\AuthController@login');
$router->get('logout/with/{key}', '\Antares\Users\Http\Controllers\LoginAs\AuthController@logout');

Route::group(['middleware' => ['web']], function () use($router) {

    $router->get('login', ['as' => 'login', 'uses' => 'CredentialController@index']);
    $router->post('login', 'CredentialController@login');
    $router->match(['GET', 'HEAD', 'DELETE'], 'logout', 'CredentialController@logout');
});


