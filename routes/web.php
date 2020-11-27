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

gk bisa logout... ada bikin project lain gk, cobe cek app layoutnya untuk logout...ngga ada, tadi ini nyariin logoutnya, disamaain sama project sebelumnya juga kan, tapi samaaaa...ad chrome gk?
aku ngga punya chrome
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/message/{id}', 'HomeController@getMessage')->name('message');
Route::post('message', 'HomeController@sendMessage');
