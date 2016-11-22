<?php
/**
 * Created by PhpStorm.
 * User: Cyril
 * Date: 20/11/2016
 * Time: 5:02 PM
 */


namespace App\Http\Controllers;

use App\answer;
use App\question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        $question = new question();
        $question->questionOrder = $request->order_num;
        $question->question_group_id = $request->group_id;
        $question->label = $request->question_label;
        $question->questionType = $request->question_type;
        $question->save();

        if($question->questionType == "singleChoice" || $question->questionType == "multipleChoice"){
            $nbchoices = $request->nb_choices;
            for($x = 0; $x <= $nbchoices; $x++) {
                $answer = new answer();
                $answer->question_id = $question->id;
                $answer->answerOrder = $x;
                $answer->label = $request->input("choice".$x);
                $answer->save();
            }
        }


        $worked = true;

        return view('admin_poll_edit_view', ['questionAdded' => $worked]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin_poll_edit_view');
    }

}