<?php
Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::prefix('permission')->group(function(){
        Route::get('list', 'AdminPermissionController@getListPermission')->middleware('can:view, App\Permission');

        Route::get('bootstrap', 'AdminPermissionController@getFormBootstrapPermission')->middleware('can:bootstrap, App\Permission');
        Route::post('bootstrap', 'AdminPermissionController@postFormBootstrapPermission');

        Route::get('add', 'AdminPermissionController@getFormPermission')->middleware('can:create, App\Permission');
        Route::post('add', 'AdminPermissionController@postFormPermission');

        Route::get('edit/{id}', 'AdminPermissionController@getEditPermission')->middleware('can:update, App\Permission');
        Route::post('edit/{id}', 'AdminPermissionController@postEditPermission');
        Route::get('delete/{id}', 'AdminPermissionController@deletePermission')->middleware('can:delete, App\Permission');
    });
});
