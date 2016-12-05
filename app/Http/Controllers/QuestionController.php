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
use Illuminate\Support\Facades\Auth;

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

        if(!empty($request->delete)){
            $this->postDeleteQuestion($request);
        } else {
                $question = new question();
                $question->question_order = $request->order_num;
                $question->label = $request->question_label;
                $question->questionType = $request->question_type;
                $question->isRequired = $request->is_required;

            if ($request->num_group_questions == "new_question_group" || question_group::find($request->num_group_questions) == null ) {
                $question_group = new question_group();
                $max_questionGroup_groupOrder = question_group::all()->max("group_order");
                $question_group->group_order = $max_questionGroup_groupOrder + 1;
                $question_group->save();
                $question->question_group_id = $question_group->id;

            } else {
                $question->question_group_id = $request->num_group_questions;
            }

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

        $questionAddedWorked = true;
        $questions = question::all();
        $questionGroups = question_group::all();
        foreach ($questionGroups as $questionGroup) {
            if (question::where('question_group_id', $questionGroup->id)->count() == 0) {
                $questionGroup->destroy($questionGroup->id);
            }
        }

        return redirect()->action('PollController@adminEditPoll')->with(['questionAdded' => $questionAddedWorked, 'questionGroups' => $questionGroups, 'questions' => $questions]);
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

    /**
     * Delete the specifed resource
     *
     * @param $id id of the question to be deleted
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        question::destroy($id);

    }

    /**
     * Update in database the visibility of a question
     * @param $id
     * @param $show
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateVisibilityQuestion($id, $show)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        $question = question::find($id);
        if($show == 1){
            $question->isVisible = 1;
        }else{
            $question->isVisible = 0;
        }
        $question->save();
    }

    /**
     * Update in database isRequired of a question
     * @param $id
     * @param $required
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRequiredQuestion($id, $required){
        if(!Auth::check())
            return redirect()->intended('login');

        $question = question::find($id);
        if($required == 1){
            $question->isRequired = 1;
        }else{
            $question->isRequired = 0;
        }
        $question->save();
    }

    /**
     * Update in database the label of a question
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function updateLabelQuestion(Request $request){
        if(!Auth::check())
            return redirect()->intended('login');

        $allresultsrequest = $request->all();
        $allkeys = array_keys($allresultsrequest);
        foreach($allkeys as $key){
            if(ends_with($key,'changed')){
                preg_match_all('!\d+!', $key, $questionIdToChanged);
                $question = question::find($questionIdToChanged[0][0]);
                $question->label = $request->input($key);
                $question->save();
            }
        }

        $questions = question::all();
        $questionGroups = question_group::all();
        foreach ($questionGroups as $questionGroup) {
            if (question::where('question_group_id', $questionGroup->id)->count() == 0) {
                $questionGroup->destroy($questionGroup->id);
            }
        }

        return redirect()->action('PollController@adminEditPoll')->with(['questionGroups' => $questionGroups, 'questions' => $questions]);
    }

}