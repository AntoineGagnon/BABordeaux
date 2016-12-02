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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

//TODO NumGroup plante quand on supprime toutes les questions par ajax car le num groupe affiché (ex 42) n'existe plus en BD du coup
//TODO faire un redirect sur le post update label question et pas return view sinon ajax marche plus
//TODO Quand il y a deux question, update que la deuxieme (donc la derniere de la liste a chaque fois car ne prend pas le $request de la premiere je pense;

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
                $question_group->group_order = $max_questionGroup_groupOrder + 1;
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

            $questionAddedWorked = true;
            $questions = question::all();
            $questionGroups = question_group::all();
            foreach ($questionGroups as $questionGroup) {
                if (question::where('question_group_id', $questionGroup->id)->count() == 0) {
                    $questionGroup->destroy($questionGroup->id);
                }
            }
            return redirect()->action('PollController@adminEditPoll')->with(['questionAdded' => $questionAddedWorked, 'questionGroups' => $questionGroups, 'questions' => $questions]);
            //return view('admin_poll_edit_view', ['questionAdded' => $questionAddedWorked, 'questionGroups' => $questionGroups, 'questions' => $questions]);
        }
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

    public function updateLabelQuestion(Request $request){
        if(!Auth::check())
            return redirect()->intended('login');

        $question = question::find($request->question_id);
        $question->label = $request->question_label;
        $question->save();

        $questionUpdated = true;
        $questions = question::all();
        $questionGroups = question_group::all();
        foreach ($questionGroups as $questionGroup) {
            if (question::where('question_group_id', $questionGroup->id)->count() == 0) {
                $questionGroup->destroy($questionGroup->id);
            }
        }

        return view('admin_poll_edit_view', ['questionUpdadated' => $questionUpdated ,'questionGroups' => $questionGroups, 'questions' => $questions]);

    }

}