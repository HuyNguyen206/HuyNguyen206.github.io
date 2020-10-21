<?php
Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::prefix('order')->group(function(){
        Route::get('list', 'OrderController@getListOrder');
        Route::get('order-detail/{id}', 'OrderController@getOrderDetail');
    });
});
