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


Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
     Route::get('news/create', 'NewsController@add');
     Route::post('news/create', 'NewsController@create'); //登録
     //一覧
     Route::get('news/management', 'NewsController@index');
     //top
     Route::get('news/top', 'NewsController@showtop');
     Route::get('news/detail/{news_id}','NewsController@show');
     Route::get('news/edit', 'NewsController@edit');
    Route::post('news/edit', 'NewsController@update');
    Route::get('news/delete', 'NewsController@delete');
    //プロフィール
    Route::get('profile/create', 'ProfileController@add');
    Route::post('profile/create', 'ProfileController@create');
    Route::get('profile/detail/{profile_id}','ProfileController@show');
    Route::get('profile/setting', 'ProfileController@edit');
    Route::post('profile/setting', 'ProfileController@update');
});

Auth::routes();

Route::get('/', 'HomeController@index');

//Route::get('/', 'NewsController@index');

Route::get('/profile', 'ProfileController@index');
Route::get('news/search', 'NewsController@search');