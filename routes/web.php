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

Route::get('/', "AdminController@index");
Route::get("/test",function(){
    return view('test');
});

Route::post('/', "AdminController@addPhoto");
Route::post('/delete',"AdminController@delete");
Route::post('/edit',"AdminController@editRedirect");
Route::post('/update',"AdminController@update");
