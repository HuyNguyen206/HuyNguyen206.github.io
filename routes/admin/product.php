<?php
Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::prefix('product')->group(function(){
        Route::get('list', 'ProductController@getListProduct')->middleware('can:view, App\Product');
        Route::get('add', 'ProductController@getFormProduct')->middleware('can:create, App\Product');
        Route::post('add', 'ProductController@postFormProduct');
        Route::get('edit/{id}', 'ProductController@getEditProduct')->middleware('can:update, App\Product');
        Route::post('edit/{id}', 'ProductController@postEditProduct');
        Route::get('delete/{id}', 'ProductController@deleteProduct')->middleware('can:delete, App\Product');
    });
});
