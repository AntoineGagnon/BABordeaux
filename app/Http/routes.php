<?php

use App\Sondage;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {

	$sondages = Sondage::orderBy('date','asc')->get();

    return view('sondage_list_view',[
    	'sondages' => $sondages]);
});


// Récupère toutes les requêtes du type /sondage/... et les redirige vers SondageController

Route::resource('sondage','SondageController');




