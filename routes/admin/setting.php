<?php
Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::prefix('setting')->group(function(){
        Route::get('list', 'SettingController@getListSetting')->middleware('can:view, App\Setting');
        Route::get('add', 'SettingController@getFormSetting')->middleware('can:create, App\Setting');
        Route::post('add', 'SettingController@postFormSetting');
        Route::get('edit/{id}', 'SettingController@getEditSetting')->middleware('can:update, App\Setting');
        Route::post('edit/{id}', 'SettingController@postEditSetting');
        Route::get('delete/{id}', 'SettingController@deleteSetting')->middleware('can:delete, App\Setting');
    });
});
