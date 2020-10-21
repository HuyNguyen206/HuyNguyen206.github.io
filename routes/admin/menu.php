<?php
Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::prefix('menu')->group(function(){
        Route::get('list', 'MenuController@getListMenu')->middleware('can:view, App\Menu');
        Route::get('add', 'MenuController@getFormMenu')->middleware('can:create, App\Menu');
        Route::post('add', 'MenuController@postFormMenu');
        Route::get('edit/{id}', 'MenuController@getEditMenu')->middleware('can:update, App\Menu');
        Route::post('edit/{id}', 'MenuController@postEditMenu');
        Route::get('delete/{id}', 'MenuController@deleteMenu')->middleware('can:delete, App\Menu');
    });
});
