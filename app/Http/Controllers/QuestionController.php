<?php
/**
 * Created by PhpStorm.
 * User: Cyril
 * Date: 20/11/2016
 * Time: 5:02 PM
 */


namespace App\Http\Controllers;

use App\question;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    //TODO Add auth verification
    public function store(Request $request)
    {

        $question = new question();
        $question->questionOrder = $request->order_num;
        $question->question_group_id = $request->group_id;
        $question->label = $request->choix;
        $question->questionType = $request->question_type;
        $question->save();
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