<?php

namespace App\Http\Controllers;

use App\guestbook_submission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class GuestbookController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //This is used to make sure the name is filled and < 255 char
        $validator = Validator::make($request->all(), [
            'text' => 'required|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect('/guestbook')
                ->withInput()
                ->withErrors($validator);
        }

        $guestsm = new guestbook_submission();
        $guestsm->username = $request->username;
        $guestsm->text = empty($request->text) ? "Anonymous" : $request->text;

        $guestsm->save();
        $worked = true;
        return view('guestbook_view',['submissionWorked' => $worked]);
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        return view('guestbook_view');
    }
}
