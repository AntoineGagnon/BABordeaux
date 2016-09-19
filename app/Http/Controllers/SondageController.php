<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Sondage;
use App\Question;
use App\Choix;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SondageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "Coucou";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sondage_creator');
    }

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
            'titre' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $sondage = new Sondage;
        $sondage->titre = $request->titre;
        $sondage->mdp = Hash::make($request->mdp);
        $sondage->save();

        echo "Sondage avec le titre $request->titre sauvegardé !";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sondage = Sondage::find($id);
        $questions = Question::where('Sondage_id','=',$id)->get();
        
        $choices = array();
        $i=0;
        foreach($questions as $question){
            $question['choices']=Choix::where('Question_id','=',$question->id)->orderBy('id','asc')->get();
            $i++;
        }
        
        //var_dump($choices);
        return view('sondage_answer',['sondage' => $sondage, 'questions' => $questions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "<br> Editing sondage $id";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sondage::findOrFail($id)->delete();
        return redirect('/');
    }
}
