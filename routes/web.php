<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::get('/simone', 'PostController@showSimone')->name('posts.simone');
    Route::get('/alessio', 'PostController@showAlessio')->name('posts.alessio');
    Route::get('/jacopo', 'PostController@showJacopo')->name('posts.jacopo');
});
    
    
// Intercetto tutte le rotte che non vengono intercettate dall'istruzione precedente
    
Route::get("{any?}", function() {
    return view("guest.home");
})->where("any", ".*");

    
