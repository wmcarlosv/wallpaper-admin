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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
	Route::resource('users','UsersController');
	Route::get('profile','UsersController@profile')->name('profile');
	Route::put('update-profile/{id}','UsersController@update_profile')->name('update_profile');
	Route::put('change-password/{id}','UsersController@change_password')->name('change_password');

	Route::resource('applications','ApplicationsController');
	Route::get('settings','ApplicationsController@settings')->name('settings');
	Route::get('update-settings/{id}','ApplicationsController@update_settings')->name('update_settings');

	Route::resource('categories','CategoriesController');
	Route::resource('wallpapers','WallpapersController');
});
