<?php

namespace App\Http\Controllers;

use App\guestbook_submission;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GuestbookController extends Controller
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

        $guestsm = new guestbook_submission();
        $guestsm->username = $request->has('username') ? $request->username : "Anonymous" ;
        $guestsm->text = $request->text;

        $guestsm->save();
        $worked = true;

        return view('guestbook_view', ['submissionWorked' => $worked]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guestbook_view');
    }

    public function adminDisplayGBResults()
    {
        if(!Auth::check())
            return redirect()->intended('login');

        $guestbook_submissions = guestbook_submission::all();

        return view('admin_guestbook_results', ['guestbook_submissions' => $guestbook_submissions ]);
    }

    public function destroy($id)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        guestbook_submission::destroy($id);

        return redirect('admin/resultguestbook');

    }
}
