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
Route::get('admin/editpoll', 'PollController@adminEditPoll');
Route::get('admin/viewpoll', 'PollController@adminDisplayPoll');
Route::get('admin/resultpoll', 'PollController@adminDisplayPollResults');
Route::get('admin/resultguestbook', 'GuestbookController@adminDisplayGBResults')->name('admin.resultguestbook');

// Pour les autres fonctions en rapport avec admin
Route::resource('admin', 'AdminController');
Route::resource('guestbook','GuestbookController');
Route::resource('question','QuestionController');


Auth::routes();

Route::get('/home', 'HomeController@index');
