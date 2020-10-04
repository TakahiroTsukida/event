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



Route::get('/', 'User\EventController@index')->name('top');
Route::get('user/event/{event}', 'User\EventController@show')->name('user.event.show');

//一般ユーザー
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    Auth::routes();

    Route::middleware('auth:user')->group(function () {

        Route::get('edit', 'UserController@edit')->name('edit');
        Route::post('update', 'UserController@update')->name('update');
        Route::post('destroy', 'UserController@destroy')->name('destroy');
        Route::get('{id}', 'UserController@show')->name('show');

        //イベントいいね
        Route::put('event/{event}/like', 'EventController@like')->name('event.like');
        Route::delete('event/{event}/like', 'EventController@unlike')->name('event.unlike');

        //イベント参加 ・ キャンセル
        Route::get('event/{event}/form', 'EventController@join_form')->name('event.join_form');
        Route::post('event/{event}/join', 'EventController@join')->name('event.join');
        Route::get('event/{event}/unjoin/confirmation', 'EventController@unjoinConfirmation')->name('event.unjoin.confirmation');
        Route::delete('event/{event}/unjoin', 'EventController@unjoin')->name('event.unjoin');
    });
});




// 管理者ログイン認証後
Route::middleware('auth:admin')->group(function () {

    Route::resource('admin', 'Admin\AdminController', ['except' => 'show']);
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes(['register' => false]);

    // 管理者ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        Route::resource('event', 'EventController', ['except' => ['index', 'show']]);
        Route::resource('shop', 'ShopController');
    });
});
