<?php
Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::get('', 'AdminController@index');
    Route::prefix('category')->group(function () {
        Route::get('list', 'CategoryController@getListCategory')->middleware('can:view, App\Category');
        Route::get('add', 'CategoryController@getFormCategory')->middleware('can:create, App\Category');
        Route::post('add', 'CategoryController@postFormCategory');
        Route::get('edit/{id}', 'CategoryController@getEditCategory')->middleware('can:update, App\Category');
        Route::post('edit/{id}', 'CategoryController@postEditCategory');
        Route::get('delete/{id}', 'CategoryController@deleteCategory')->middleware('can:delete, App\Category');
    });
});
