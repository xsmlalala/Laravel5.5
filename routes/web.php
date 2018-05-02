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
//
//Route::get('/home', function () {
//    return view('home');
//});

//Route::get('/login', function () {
//    return view('login');
//});
Route::get('/home', "\App\Http\Controllers\Home\LoginController@home");
Route::get('/login', "\App\Http\Controllers\Home\LoginController@index");
Route::get('/myFriends', "\App\Http\Controllers\Home\LoginController@myFriends");
Route::get('/register', "\App\Http\Controllers\Home\RegisterController@index");
Route::get('/add/{id}', "\App\Http\Controllers\Home\RegisterController@add");
Route::post('/getmsg',"\App\Http\Controllers\Home\RegisterController@getmsg");
// Route::get('/getmsg/{received_id}',"\App\Http\Controllers\Home\RegisterController@getmsg");

Route::post('/logininfo',"\App\Http\Controllers\Home\LoginController@login");
Route::post('/registerinfo',"\App\Http\Controllers\Home\RegisterController@register");