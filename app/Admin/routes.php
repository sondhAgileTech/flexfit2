<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('contracts', ContractController::class);
    $router->resource('products', ProductController::class);
    $router->resource('question-answer', QuestionAnswerController::class);
    $router->get('/api/product','\App\Http\Controllers\ProductController@getSearch');
});
