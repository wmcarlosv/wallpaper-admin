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
	Route::put('change-password/{id}','UsersController@update_password')->name('update_password');

	Route::resource('applications','ApplicationsController');

	Route::get('/application/{slug}','ApplicationsController@application_dashboard')->name('application_dashboard');

	Route::resource('categories','CategoriesController',['except' => ['index','create','edit']]);
	Route::get('/application/{slug}/categories','CategoriesController@index')->name('categories.index');
	Route::get('/application/{slug}/categories/create','CategoriesController@create')->name('categories.create');
	Route::get('/application/{slug}/categories/edit/{id}','CategoriesController@edit')->name('categories.edit');

	Route::resource('wallpapers','WallpapersController',['except' => ['index','create','edit']]);

	Route::get('/application/{slug}/wallpapers','WallpapersController@index')->name('wallpapers.index');
	Route::get('/application/{slug}/wallpapers/create','WallpapersController@create')->name('wallpapers.create');
	Route::get('/application/{slug}/wallpapers/edit/{id}','WallpapersController@edit')->name('wallpapers.edit');
});

Route::group(['prefix' => 'api/v1'], function(){
	Route::get('/{api_key}/home','ApiController@api_home');
	Route::get('/{api_key}/wallpapers','ApiController@wallpapers');
	Route::get('/{api_key}/categories','ApiController@categories');
});
