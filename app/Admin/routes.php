<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    Route::get('/', function () {
        return redirect('/admin/contracts');
    });
    $router->resource('contracts', ContractController::class);
    $router->resource('products', ProductController::class);
    $router->resource('question-answer', QuestionAnswerController::class);
    $router->resource('list-contract-maintain', ListContractMaintainController::class);
    $router->resource('ask-advice', AskAdviceController::class);
    $router->resource('contract-text', ContracTextController::class);
    $router->resource('notification', NotificationController::class);
    $router->resource('contracts_warranty_1', ContractWarranty1Controller::class);
    $router->resource('contracts_warranty_2', ContractWarranty2Controller::class);
    $router->resource('contracts_warranty_3', ContractWarranty3Controller::class);
    $router->resource('noti-change-time-contract', NotiChangeTimeContractController::class);
    $router->get('/api/product','\App\Http\Controllers\ProductController@getSearch');
    $router->post('contract/csv/import', '\App\Admin\Controllers\ContractController@import');
    $router->post('contract/csv/import/product', '\App\Admin\Controllers\ContractController@importProductOfContract');
});
