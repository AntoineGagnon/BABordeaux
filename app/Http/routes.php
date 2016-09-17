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


/**
 * Add A New Sondage
 */
Route::post('/sondage', function (Request $request) {

	//This is used to make sure the name is filled and < 255 char
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $sondage = new Sondage;
    $sondage->title = $request->title;
    $sondage->date = time();
    $sondage->mdp = uniqid();
    $sondage->save();
});

/**
 * Delete An Existing Task
 */
Route::delete('/sondage/delete/{id}', function ($id) {
    Sondage::findOrFail($id)->delete();

    return redirect('/');
});

/**
 * Edit An Existing Task
 */
Route::post('/sondage/edit/{id}',function($id){
	//TODO
});

/**
 * Answer An Existing Task
 */
Route::get('/sondage/answer/{id}',function($id){
	//TODO
});

/**
 * Create a Task
 */
Route::get('/sondage/create',function(){
    //TODO
	 return view('sondage_creator');
});



