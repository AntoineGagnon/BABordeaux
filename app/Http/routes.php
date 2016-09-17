<?php

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

	$sondages = Sondage::orderBy('title','asc')->get();

    return view('sondage_creator',[
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
    $sondage->name = $request->title;
    $sondage-> save();
});

/**
 * Delete An Existing Task
 */
Route::delete('/sondage/delete/{id}', function ($id) {
    Sondage::findOrFail($id)->delete();

    return redirect('/');
});

Route::edit('sondage/edit/{id}',function($id){
	//TODO
});

