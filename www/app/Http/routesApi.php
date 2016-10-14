<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => [
        'cors',
    ],
    'namespace' => 'Api',
    'prefix' => 'api/v1',
], function () {
    $options = [
        'except' => [
            'create',
            'edit',
        ]
    ];
    Route::resource('product', 'ProductsController', $options);
    Route::resource('categories', 'CategoriesController', $options);
    Route::resource('baskets', 'BasketController', $options);
});