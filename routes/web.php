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
    return view('auth.login');
});

Auth::routes([
    'verify' => false,
    'reset'  => false,
]);

Route::get('profile-edit', 'HomeController@editProfile')->name('profile-edit');
Route::patch('profile-update', 'HomeController@updateProfile')->name('profile-update');
Route::patch('profile-update-password', 'HomeController@updatePassword')->name('profile-update-password');
Route::get('home', 'HomeController@index')->name('home');
