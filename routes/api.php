<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
    Route::get('check', 'Checker@check');
    Route::post('signin', 'JWTAuth@signIn');
    Route::post('signout', 'JWTAuth@signOut');
});

Route::group(['prefix' => 'v1'], function() {
    // This route points to a resource controller
    Route::resource('products', 'Products');
    // Route::put('products/{id}/status', 'Products@status');
});