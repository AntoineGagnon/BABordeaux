<?php
namespace App\Http\Controllers;

use App\answer;
use App\choice;
use App\question_group;
use App\submission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Sondage;
use App\question;
use App\Choix;
use App\Reponse;
use App\Http\Requests;
use Khill\Lavacharts\Lavacharts as Lava;

class PollController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sub = new submission();


        $sub->save();

        $maxID = question::all()->max('id');
        for ($i = 0; $i <= $maxID; $i++) {
            if($request->has('question_' . $i)) {
                $value = $request->input('question_' . $i);
                // Checkbox question
                if (is_array($value)) {
                    foreach ($value as $checkboxChoice) {
                        $choice = new choice();
                        $choice->question_id = $i;
                        $choice->answer_id = $checkboxChoice;
                        $choice->submission_id = $sub->id;
                        $choice->save();
                    }
                } // Radio question
                elseif (is_numeric($value)) {
                    $choice = new choice();
                    $choice->question_id = $i;
                    $choice->answer_id = $value;
                    $choice->submission_id = $sub->id;
                    $choice->save();
                }
                // Open question
                else {
                    $answer = new answer();
                    $answer->question_id = $i;
                    $answer->answer_order = 0;
                    $answer->label = $value;
                    $answer->save();

                    $choice = new choice();
                    $choice->question_id = $i;
                    $choice->answer_id = $answer->id;
                    $choice->submission_id = $sub->id;
                    $choice->save();
                }
            }
        }

        return redirect('/')->with("submissionWorked", true);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionGroups = question_group::whereExists(function ($query) {
            $query->select(DB::raw(1))->from('questions')->whereRaw('questions.question_group_id = question_groups.id')->where('isVisible', 1);
        })->get();

        foreach ($questionGroups as $questionGroup) {
            $questionGroup['questions'] = question::where('question_group_id', $questionGroup->id)->orderBy('question_order', 'asc')->get();
            foreach ($questionGroup['questions'] as $question) {
                $question['answers'] = answer::where('question_id', $question->id)->orderBy('answer_order', 'asc')->get();
            }
        }

        return view('poll_view', ['questionGroups' => $questionGroups]);
    }

    /**
     * ADMIN: Edit a poll
     *
     * @param int $idPoll The poll to edit
     * @return \Illuminate\Http\Response
     */
    public function adminEditPoll()
    {
        if(!Auth::check())
            return redirect()->intended('login');

        $questionGroups = question_group::all();

        foreach($questionGroups as $questionGroup){
            if(question::where('question_group_id',$questionGroup->id)->count() == 0)
            {
                $questionGroup->destroy($questionGroup->id);
            }
        }

        return view('admin_poll_edit_view', ['questionGroups' => $questionGroups]);
    }

    /**
     * ADMIN: Display a poll
     *
     * @param int $idPoll The poll to display
     * @return \Illuminate\Http\Response
     */
    public function adminDisplayPoll()
    {
        if(!Auth::check())
            return redirect()->intended('login');

        return view('admin_poll_display', []);
    }

    /**
     * ADMIN: Display the results of a poll
     *
     * @param int $idPoll The poll
     * @return \Illuminate\Http\Response
     */
    public function adminDisplayPollResults()
    {
        if(!Auth::check())
            return redirect()->intended('login');

        $questionGroups = question_group::whereExists(function ($query) {
            $query->select(DB::raw(1))->from('questions')->whereRaw('questions.question_group_id = question_groups.id')->where('isVisible', 1);
        })->get();

        foreach ($questionGroups as $questionGroup) {
            $questionGroup['questions'] = question::where('question_group_id', $questionGroup->id)->orderBy('question_order', 'asc')->get();
            foreach ($questionGroup['questions'] as $question) {
                $questions[$question['attributes']['id']]['id'] = $question['attributes']['id'];
                $questions[$question['attributes']['id']]['label'] = $question['attributes']['label'];
                $questions[$question['attributes']['id']]['type'] = $question['attributes']['questionType'];
            }
        }

        foreach($questions as $quest)
        {
            if($quest['type'] == 'singleChoice')
            {

                $choices = DB::table('choices')
                     ->select(DB::raw('id, question_id, answer_id'))
                     ->where('question_id', '=', $quest['id'])
                     ->get();

                foreach($choices as $choice)
                {
                    $choiceArray = json_decode(json_encode($choice), true);
                    $count[$choiceArray['answer_id']] = 0;
                }

                foreach($choices as $choice)
                {
                    $choiceArray = json_decode(json_encode($choice), true);
                    $count[$choiceArray['answer_id']] = $count[$choiceArray['answer_id']]+1;
                }

                $total = 0;

                foreach($count as $test)
                    $total = $total + $test;

                $age = \Lava::DataTable();
                $age->addStringColumn('Tranche Age')
                    ->addNumberColumn('Pourcentage');

                $age->addRow(['0-25', ($count[1]*100)/$total])
                    ->addRow(['25-50', ($count[2]*100)/$total])
                    ->addRow(['+50', 0]);

                \Lava::PieChart('Age', $age, [
                    'title' => 'Tranches d\'âge des visiteurs',
                    'is3D' => true,
                    'sliceVisibilityThreshold' => 0
                    ]);
                    }
        }

        return view('admin_poll_display_results', []);
    }

}
