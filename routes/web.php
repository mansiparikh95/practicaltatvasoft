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

Route::get('/', function () {
    return view('welcome');
});

Route::post('details','BlogController@postList')->name('details');

Auth::routes();

Route::middleware(['auth'])->group(function (){ 
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('logout','HomeController@logout')->name('logout');
	Route::group(['prefix' => 'admin','namespace' => 'admin'], function() {
		Route::resource('blog','BlogController');
		Route::post('blogdetails','BlogController@postList')->name('blogdetails');
		
	});
});


