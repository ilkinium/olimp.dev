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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
    ->namespace('Admin')
    ->as('admin.')
    ->group( function () {
        Route::get('/dashboard', 'PagesController@index')->name('dashboard');
        Route::resource('pages', 'PagesController');
        Route::resource('categories', 'CategoriesController');
        Route::resource('articles', 'ArticlesController');
        Route::resource('menus', 'MenusController');
    });