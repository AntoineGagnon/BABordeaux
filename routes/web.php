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
Route::get('regexp','ArtworkController@regexpTester');
Route::post('regexp/search','ArtworkController@searchForArtwork');

// Fonctions spécifiques à l'admin
Route::post('login/authenticate', 'LoginController@authenticate');
Route::get('admin/editpoll', 'PollController@adminEditPoll');
Route::get('admin/editartworks', 'ArtworkController@adminEditArtworks');
Route::get('admin/exportguestbookresults/{format}','PollController@adminExportGuestBookResults');
Route::get('admin/exportpollresults','PollController@adminExportPollResults');
Route::get('admin/resultpoll', 'PollController@adminDisplayPollResults');
Route::get('admin/resultguestbook', 'GuestbookController@adminDisplayGBResults');
Route::get('admin/change_password', 'AdminController@changePassword');
Route::get('artwork/getartworkbyanswer/{answerid}','ArtworkController@getArtworkByID');
Route::post('admin/postPasswordChange', 'AdminController@postPasswordChange');
Route::post('admin/updateVisibility/{id}/{show}','QuestionController@updateVisibilityQuestion');
Route::post('admin/updateRequired/{id}/{required}','QuestionController@updateRequiredQuestion');
Route::post('/admin/updateLabel','QuestionController@updateLabelQuestion');

// Pour les autres fonctions en rapport avec admin
Route::resource('login', 'LoginController');
Route::get('logout', 'LoginController@logout');
Route::post('login/authenticate', 'LoginController@authenticate');
Route::resource('admin', 'AdminController');
Route::resource('guestbook','GuestbookController');
Route::resource('question','QuestionController');
Route::resource('artwork','ArtworkController');


Route::get('ruleMaker', 'RuleController@ruleMaker');
Route::resource('rule', 'RuleController');
