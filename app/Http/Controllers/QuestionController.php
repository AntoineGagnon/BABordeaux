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
use Illuminate\Http\Request;


class QuestionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    //TODO conditionnal QUESTION

    public function store(Request $request)
    {

        $question = new question();
        /*if($request->num_group_questions != "new_question_group"): {
            empty(question::where('question_group_id', $request->num_group_questions)
                ->where('question_order', $request->order_num)->get()) ? $question->question_order = $request->order_num
                : $question->question_order = $request->order_num + 1;
        }else:
        {
            $question->question_order = $request->order_num;
        }
        endif;*/
        $question->question_order = $request->order_num;
        $question->label = $request->question_label;
        $question->questionType = $request->question_type;
        $question->isRequired = $request->is_required;

        if ($request->num_group_questions == "new_question_group") {
            $question_group = new question_group();
            $max_questionGroup_groupOrder = question_group::all()->max("group_order");
            $question_group->group_order = $max_questionGroup_groupOrder;
            $question_group->save();
            $question->question_group_id = $question_group->id;
        } else {
            $question->question_group_id = $request->num_group_questions;
        }

        $question->save();

        if ($question->questionType == "singleChoice" || $question->questionType == "multipleChoice") {
            $nbchoices = $request->nb_choices;
            for ($x = 0; $x <= $nbchoices; $x++) {
                $answer = new answer();
                $answer->question_id = $question->id;
                $answer->answer_order = $x;
                $answer->label = $request->input("choice" . $x);
                $answer->save();
            }
        }

        $worked = true;

        $questionGroups = question_group::all();
        foreach($questionGroups as $questionGroup){
            if(question::where('question_group_id',$questionGroup->id)->count() == 0)
            {
                $questionGroup->destroy($questionGroup->id);
            }
        }

        return view('admin_poll_edit_view', ['questionAdded' => $worked, 'questionGroups' => $questionGroups]);
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