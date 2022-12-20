<?php

use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('/notifications', NotificationController::class);
    $router->resource('/pattern_user', PatternUserController::class);
    $router->post('/pattern_user/import', 'PatternUserController@csvImport');
    $router->resource('/patterns', PatternController::class);
});
