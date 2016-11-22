<?php
namespace App\Http\Controllers;

use App\answer;
use App\choice;
use App\question_group;
use App\submission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Sondage;
use App\question;
use App\Choix;
use App\Reponse;
use App\Http\Requests;

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
                // Non open question
                if(is_numeric($value)){
                    $choice = new choice();
                    $choice->question_id = $i;
                    $choice->answer_id = $value;
                    $choice->submission_id = $sub->id;
                    $choice->save();
                }
                // Open question
                else {
                    //TODO Open answer
                }
            }
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionGroups = question_group::all();

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
        $this->middleware('auth');
        return view('admin_poll_edit_view', []);
    }

    /**
     * ADMIN: Display a poll
     *
     * @param int $idPoll The poll to display
     * @return \Illuminate\Http\Response
     */
    public function adminDisplayPoll()
    {
        $this->middleware('auth');
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
        $this->middleware('auth');
        return view('admin_poll_display_results', []);
    }

}
