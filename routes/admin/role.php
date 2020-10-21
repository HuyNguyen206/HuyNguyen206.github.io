<?php
Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::prefix('role')->group(function(){
        Route::get('list', 'AdminRoleController@getListRole')->middleware('can:view, App\Role');
        Route::get('add', 'AdminRoleController@getFormRole')->middleware('can:create, App\Role');
        Route::post('add', 'AdminRoleController@postFormRole');
        Route::get('edit/{id}', 'AdminRoleController@getEditRole')->middleware('can:update, App\Role');
        Route::post('edit/{id}', 'AdminRoleController@postEditRole');
        Route::get('delete/{id}', 'AdminRoleController@deleteRole')->middleware('can:delete, App\Role');
    });
});
