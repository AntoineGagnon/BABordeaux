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

    /**
     * Update in database an artwork
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function updateArtwork(Request $request){
        if(!Auth::check())
            return redirect()->intended('login');

        $allresultsrequest = $request->all();
        $allkeys = array_keys($allresultsrequest);
        foreach($allkeys as $key){
            if(ends_with($key,'_artistchanged')){
                preg_match_all('!\d+!', $key, $artworkIdToChanged);
                $artwork = artwork::find($artworkIdToChanged[0][0]);
                $artwork->artist = $request->input($key);
                $artwork->save();

            }

            if(ends_with($key,'_titlechanged')){
                preg_match_all('!\d+!', $key, $answerIdToChanged);
                $artwork = artwork::find($answerIdToChanged[0][0]);
                $artwork->title = $request->input($key);
                $artwork->save();

            }

            if(ends_with($key,'_datechanged')){
                preg_match_all('!\d+!', $key, $answerIdToChanged);
                $artwork = artwork::find($answerIdToChanged[0][0]);
                $artwork->date = $request->input($key);
                $artwork->save();

            }

            if(ends_with($key,'_urlchanged')){
                preg_match_all('!\d+!', $key, $answerIdToChanged);
                $artwork = artwork::find($answerIdToChanged[0][0]);
                $artwork->image_url = $request->input($key);
                $artwork->save();

            }

            if(ends_with($key,'_typechanged')){
                preg_match_all('!\d+!', $key, $answerIdToChanged);
                $artwork = artwork::find($answerIdToChanged[0][0]);
                $artwork->type = $request->input($key);
                $artwork->save();

            }

        }

        return redirect()->action('ArtworkController@adminEditArtworks');
    }
}
