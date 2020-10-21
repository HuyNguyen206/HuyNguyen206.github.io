<?php

use App\User;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('test-password', function(){
//    echo \Illuminate\Support\Facades\Hash::make('123456');
//});

//Basic Router of BackEnd
    Route::get('admin/login', 'AdminController@GetFormlogin');
    Route::post('admin/login', 'AdminController@PostFormlogin');
    Route::get('admin/logout', 'AdminController@Logout');
//Auth Route
Auth::routes(['verify' => true]);
//store a push subscriber.
Route::post('/push','PushController@store');
//make a push notification.
Route::get('/push','PushController@push')->name('push');
Route::get('test-mail', function () {
    $data['name'] = 'Tester';
    $data['reset-link'] = 'http://test-send-mail';
    return (new App\Notifications\SendEmailResetPass($data))
        ->toMail(User::where('email', 'nguyenlehuyuit@gmail.com')->first());
});
Route::post('password/send-email', 'FrontEnd\FrontEndResetPasswordController@sendEmail')->name('password.send-email');
Route::post('password/password-reset', 'FrontEnd\FrontEndResetPasswordController@passwordReset')->name('password.password-reset');
Route::get('password/password-reset', function(){
    return redirect('/');
});
//Router of FrontEnd
Route::get('/','FrontEnd\HomeController@index');
Route::get('home','FrontEnd\HomeController@index')->name('home');
Route::get('contact', 'FrontEnd\HomeController@showContact');
Route::post('contact', 'FrontEnd\HomeController@storeContact');



Route::get('add-to-cart/{id}/{quantity?}','FrontEnd\CartController@addToCart');
Route::get('show-cart','FrontEnd\CartController@showCart');
Route::get('update-cart','FrontEnd\CartController@updateCart');
Route::get('remove-cart-product/{id}','FrontEnd\CartController@removeCartProduct');
Route::get('checkout','FrontEnd\CartController@checkout')->middleware(['checkLoginFrontEnd','verified']);;
Route::post('order','FrontEnd\CartController@order');
Route::get('return-vnpay', 'FrontEnd\CartController@handleReturnData');
Route::get('apply-coupon', 'FrontEnd\CartController@checkCoupon' );
Route::get('remove-coupon', 'FrontEnd\CartController@removeCoupon' );

Route::get('login', 'FrontEnd\UserController@login');
Route::get('logout', 'FrontEnd\UserController@logout');
Route::get('user-register', 'FrontEnd\UserController@login');

Route::post('user-sign-in', 'FrontEnd\UserController@userSignIn')->name('login-frontend');
Route::post('user-register', 'FrontEnd\UserController@userRegister')->name('register-frontend');;
Route::get('get-district-by-city/{id}','FrontEnd\UserController@getDistrictById');

Route::get('search-product', 'FrontEnd\ProductController@searchProduct');
//Socialite Authentication
Route::get('login/{provider}','FrontEnd\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'FrontEnd\SocialAccountController@handleProviderCallback');


Route::get('{categoryParent}','FrontEnd\ProductController@showProductBelongToCategory')->where(['categoryParent' => '[a-zA-Z0-9-]+']);
Route::get('{categoryParent}/{categoryType?}','FrontEnd\ProductController@showProductBelongToCategory')->where(['categoryParent' => '[a-zA-Z0-9-]+', 'categoryType' => '[a-zA-Z0-9-]+']);
Route::get('{categoryType}/{productId}/{productName?}','FrontEnd\ProductController@showProductDetail')
    ->where(['categoryType' => '[a-zA-Z0-9-]+', 'productId' => '[0-9]+', 'productName' => '[a-zA-Z0-9-]+']);
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});




//Route::get('home', 'HomeController@index')->name('home');
