<?php

namespace App\Http\Controllers;

use App\artwork;
use App\guestbook_submission;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ArtworkController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //This is used to make sure the name is filled and < 255 char
        $validator = Validator::make($request->all(), [
            'text' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/guestbook')
                ->withInput()
                ->withErrors($validator);
        }

        $artwork = new artwork();
        $artwork->artwork_name = $request->filename;
        $artwork->artist = $request->artist;
        $artwork->date = $request->date;
        $artwork->movement = $request->has('movement') ? $request->movement : "" ;

        $artwork->save();
        $worked = true;

        return redirect()->action('PollController@adminEditPoll')->with(['$worked' => $worked]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return view('guestbook_view');
    }


    public function destroy($id)
    {
        if(!Auth::check())
            return redirect()->intended('login');
        artwork::destroy($id);
    }

}