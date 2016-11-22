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

Route::resource('/', 'PollController');
Route::resource('poll','PollController');

// Fonctions spécifiques à l'admin
Route::post('login/authenticate', 'LoginController@authenticate');
Route::get('admin/editpoll', 'PollController@adminEditPoll');
Route::get('admin/viewpoll', 'PollController@adminDisplayPoll');
Route::get('admin/resultpoll', 'PollController@adminDisplayPollResults');
Route::get('admin/resultguestbook', 'GuestbookController@adminDisplayGBResults');
Route::get('admin/change_password', 'AdminController@changePassword');
Route::post('admin/postPasswordChange', 'AdminController@postPasswordChange');

// Pour les autres fonctions en rapport avec admin
Route::resource('login', 'LoginController');
Route::get('logout', 'LoginController@logout');
Route::post('login/authenticate', 'LoginController@authenticate');
Route::resource('admin', 'AdminController');
Route::resource('guestbook','GuestbookController');
Route::resource('question','QuestionController');