<?php
Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::prefix('slider')->group(function(){
        Route::get('list', 'SliderController@getListSlider')->middleware('can:view, App\Slider');
        Route::get('add', 'SliderController@getFormSlider')->middleware('can:create, App\Slider');
        Route::post('add', 'SliderController@postFormSlider');
        Route::get('edit/{id}', 'SliderController@getEditSlider')->middleware('can:update, App\Slider');
        Route::post('edit/{id}', 'SliderController@postEditSlider');
        Route::get('delete/{id}', 'SliderController@deleteSlider')->middleware('can:delete, App\Slider');
    });
});
