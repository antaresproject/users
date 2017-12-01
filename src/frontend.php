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

if (config('users.allow_registration', true)) {
    $router->group(['middleware' => ['web']], function (Router $router) {
        $router->resource('register', '\Antares\Users\Http\Controllers\Account\ProfileCreatorController');
    });
}
Foundation::namespaced('Antares\Users\Http\Controllers', function (Router $router) {
//    $router->group(['prefix' => 'forgot'], function (Router $router) {
//        $router->get('/', 'Account\PasswordBrokerController@create');
//        $router->post('/', 'Account\PasswordBrokerController@store');
//        $router->match(['GET', 'POST'], 'reset/{token}', 'Account\PasswordBrokerController@show');
//        $router->post('reset', 'Account\PasswordBrokerController@update');
//    });
//
//    $router->group(['prefix' => 'account'], function (Router $router) {
//        $router->get('/', 'Account\ProfileUpdaterController@edit');
//        $router->post('/', 'Account\ProfileUpdaterController@update');
//        $router->get('password', 'Account\PasswordUpdaterController@edit');
//        $router->post('password', 'Account\PasswordUpdaterController@update');
//        $router->post('picture', 'UsersController@picture');
//        $router->get('gravatar', 'UsersController@gravatar');
//    });
});
$router->group(['prefix' => 'forgot'], function (Router $router) {
    $router->get('/', '\Antares\Users\Http\Controllers\Account\PasswordBrokerController@create');
    $router->post('/', '\Antares\Users\Http\Controllers\Account\PasswordBrokerController@store');
    $router->match(['GET', 'POST'], 'reset/{token}', '\Antares\Users\Http\Controllers\Account\PasswordBrokerController@show');
    $router->post('reset', '\Antares\Users\Http\Controllers\Account\PasswordBrokerController@update');
});
$router->group(['prefix' => 'account'], function (Router $router) {
    $router->get('/', '\Antares\Users\Http\Controllers\Account\ProfileUpdaterController@edit');
    $router->post('/', '\Antares\Users\Http\Controllers\Account\ProfileUpdaterController@update');
    $router->get('password', '\Antares\Users\Http\Controllers\Account\PasswordUpdaterController@edit');
    $router->post('password', '\Antares\Users\Http\Controllers\Account\PasswordUpdaterController@update');
    $router->post('picture', '\Antares\Users\Http\Controllers\UsersController@picture');
    $router->get('gravatar', '\Antares\Users\Http\Controllers\UsersController@gravatar');
});
Route::group(['middleware' => ['web']], function () use($router) {
    if (env('APP_DEMO')) {
        $router->get('users/login', ['as' => 'login', 'uses' => '\Antares\Users\Http\Controllers\CredentialController@index']);
        $router->get('login', ['as' => 'login', 'uses' => '\App\Http\Controllers\WelcomeController@demo']);
        $router->post('login', '\Antares\Users\Http\Controllers\CredentialController@login');
        $router->match(['GET', 'HEAD', 'DELETE'], 'logout', '\Antares\Users\Http\Controllers\CredentialController@logout');
    } else {
        $router->get('login', ['as' => 'login', 'uses' => '\Antares\Users\Http\Controllers\CredentialController@index']);
        $router->post('login', '\Antares\Users\Http\Controllers\CredentialController@login');
        $router->match(['GET', 'HEAD', 'DELETE'], 'logout', 'Antares\Users\Http\Controllers\CredentialController@logout');
    }

    $router->get('antares/login/with/{id}', 'Antares\Users\Http\Controllers\LoginAs\AuthController@login');
    $router->get('antares/logout/with/{key}', 'Antares\Users\Http\Controllers\LoginAs\AuthController@logout');
    $router->get('login/with/{id}', 'Antares\Users\Http\Controllers\LoginAs\AuthController@login');
    $router->get('logout/with/{key}', 'Antares\Users\Http\Controllers\LoginAs\AuthController@logout');
});
