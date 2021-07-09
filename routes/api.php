<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the 'api' middleware group. Enjoy building your API!
|
*/

Route::post('all-users', 'FriendController@allUsers');
Route::post('available-users', 'FriendController@availableUsers');
Route::post('user-friends', 'FriendController@userFriends');
Route::post('friend-store', 'FriendController@friendStore');

Route::post('message-index', 'MessageController@messageIndex');
Route::post('message-store', 'MessageController@messageStore');
