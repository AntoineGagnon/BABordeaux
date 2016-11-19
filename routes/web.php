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
Route::resource('admin/editpoll', 'PollController@adminEditPoll');
Route::resource('admin/viewpoll', 'PollController@adminDisplayPoll');
Route::resource('admin/resultpoll', 'PollController@adminDisplayPollResults');
Route::resource('admin/resultguestbook', 'GuestbookController@adminDisplayGBResults');

// Pour les autres fonctions en rapport avec admin
Route::resource('admin', 'AdminController');
Route::resource('guestbook','GuestbookController');


Auth::routes();

Route::get('/home', 'HomeController@index');