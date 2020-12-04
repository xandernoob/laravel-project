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

Route::delete('/visitor/leave/{id}', 'App\Http\Controllers\VisitorController@softdelete')->name('visitor.softdelete');

Route::resource('/condominium', 'App\Http\Controllers\CondominiumController');

Route::resource('/visitor', 'App\Http\Controllers\VisitorController');
