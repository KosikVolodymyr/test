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

Route::get('/', 'CategoryController@index')->name('category.index');

Route::resource('/category', 'CategoryController');
Route::get('/post/nonecategory', 'PostController@noneCategory')->name('post.nonecategory');
Route::resource('/post', 'PostController');
Route::get('/post/create/{category}', 'PostController@createWithCategory')->name('post.category');
Route::get('/post/download/{slug}', 'PostController@download')->name('post.download');

Route::post('/categorycomment', 'AjaxController@addCategoryComment')->name('addCategoryComment');
Route::post('/comment', 'AjaxController@addComment')->name('addComment');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/logout', 'AuthController@logout');
});

Route::group(['middleware' => 'guest'], function(){
    Route::get('/register', 'AuthController@registerForm');
    Route::post('/register', 'AuthController@register')->name('register');
    Route::get('/login', 'AuthController@loginForm')->name('loginForm');
    Route::post('/login', 'AuthController@login')->name('login');
});

