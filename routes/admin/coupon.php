<?php
Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::prefix('coupon')->group(function(){
        Route::get('list', 'CouponController@getListCoupon');
        Route::get('add', 'CouponController@getFormCoupon');
        Route::post('add', 'CouponController@postFormCoupon');
        Route::get('edit/{id}', 'CouponController@getEditCoupon');
        Route::post('edit/{id}', 'CouponController@postEditCoupon');
        Route::get('delete/{id}', 'CouponController@deleteCoupon');
    });
});
