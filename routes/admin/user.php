<?php
Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::prefix('user')->group(function(){
        Route::get('list', 'AdminUserController@getListUser')->middleware('can:view, App\User');
        Route::get('add', 'AdminUserController@getFormUser')->middleware('can:create, App\User');
        Route::post('add', 'AdminUserController@postFormUser');
        Route::get('edit/{id}', 'AdminUserController@getEditUser')->middleware('can:update, App\User');
        Route::post('edit/{id}', 'AdminUserController@postEditUser');
        Route::get('delete/{id}', 'AdminUserController@deleteUser')->middleware('can:delete, App\User');
    });
});
