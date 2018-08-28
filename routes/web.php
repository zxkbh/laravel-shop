<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'PagesController@root')->name('root');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
 	Route::get('/email_verify_notice', 'PagesController@emailVerifyNotice')->name('email_verify_notice');
    Route::get('/email_verification/verify', 'EmailVerificationController@verify')->name('email_verification.verify');
    //手动验证邮箱
    Route::get('/email_verification/send', 'EmailVerificationController@send')->name('email_verification.send');
    // 开始
    Route::group(['middleware' => 'email_verified'], function() {
        Route::get('/test', function() {
            return 'Your email is verified';
        });

        //收货地址列表
        Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');
        //添加或编辑收货地址页面
        Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
        //添加收货地址
        Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');
        //编辑地址页面
        Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');
        //编辑收货地址
        Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');
        //删除收货地址
        Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');

    });
    // 结束
});
