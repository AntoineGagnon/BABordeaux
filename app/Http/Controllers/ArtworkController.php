<?php

namespace App\Http\Controllers;

use App\answer;
use App\artwork;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use MarkWilson\VerbalExpression;


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

        $artwork = new artwork();
        $artwork->artist = $request->artist;
        $artwork->title = $request->title;
        $artwork->date = $request->date;
        $artwork->type = $request->has('type') ? $request->type : "";
        $artwork->location = $request->has('location') ? $request->location : "";
        $artwork->image_url = $request->has('image_url') ? $request->image_url : "";

        $artwork->save();

        return redirect()->action('ArtworkController@adminEditArtworks')->with("artworkAdded",true);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return view('');
    }

    public function regexpTester()
    {

        $attributes = Schema::getColumnListing("artworks");


        return view('regexp_view', ['attributes' => $attributes]);

    }

    public function getArtworkByID($answerid)
    {
        if (is_null($answerid) || answer::find($answerid)) {
            return "Answer id isn't valid";
        }

    }

    /**
     * ADMIN: Edit artworks
     *
     * @return \Illuminate\Http\Response
     */
    public function adminEditArtworks()
    {
        if (!Auth::check())
            return redirect()->intended('login');

        //fetch all artworks from database.
        $artworks = artwork::take(25)->get();

        return view('admin_artworks_edit_view', ['artworks' => $artworks,]);
    }

    /**
     * Destroy an artwork from the database
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        if (!Auth::check())
            return redirect()->intended('login');
        artwork::destroy($id);
    }

}
