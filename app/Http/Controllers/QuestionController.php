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
use App\question_group;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;


class QuestionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    //TODO SELECT EXISTING GROUP OR CREATE NEW ONE
    //TODO isVISIBLE QUESTION
    //TODO conditionnal QUESTION

    public function store(Request $request)
    {

        $question = new question();
        empty(question::where('question_group_id', $request->group_id)
                        ->where('question_order', $request->order_num)->get()) ? $question->question_order = $request->order_num
                                                                                : $question->question_order = $request->order_num+1;

        $question->label = $request->question_label;
        $question->questionType = $request->question_type;
        $question->isRequired = $request->is_required;


        if(question_group::find($request->group_id) == null):
        {
            $question_group = new question_group();
            //$question_group->id = $request->group_id;
            $max_questionGroup_groupOrder = question_group::all()->max("group_order");
            $question_group->group_order = $max_questionGroup_groupOrder+1;
            $question_group->save();
            $question->question_group_id = $question_group->id;
        }else:
        {
            $question->question_group_id = $request->group_id;
        }
        endif;

        $question->save();

        if($question->questionType == "singleChoice" || $question->questionType == "multipleChoice"){
            $nbchoices = $request->nb_choices;
            for($x = 0; $x <= $nbchoices; $x++) {
                $answer = new answer();
                $answer->question_id = $question->id;
                $answer->answer_order = $x;
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