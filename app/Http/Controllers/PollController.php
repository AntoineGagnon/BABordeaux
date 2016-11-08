<?php
namespace App\Http\Controllers;
use App\answer;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //This is used to make sure the name is filled and < 255 char
        $validator = Validator::make($request->all(), [
            'titre' => 'required|max:255',
            'mdp' => 'required|max:60',
            'q_label1' => 'required',
            'choice1_1' => 'required_with:q_label1',
            'choice1_2' => 'required_with:q_label1',
            'choice2_1' => 'required_with:q_label2',
            'choice2_2' => 'required_with:q_label2',
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
        $question1 = new Question;
        $question1->label = $request->q_label1;
        $question1->Sondage_Id =$sondage->id;
        $question1->ordre = 1;
        $question1->save();
        $choix1_1 = new Choix;
        $choix1_1->Question_Id = $question1->id;
        $choix1_1->label = $request->choice1_1;
        $choix1_1->save();
        $choix1_2 = new Choix;
        $choix1_2->Question_Id = $question1->id;
        $choix1_2->label = $request->choice1_2;
        $choix1_2->save();
        if(!empty($request->q_label2)){
            $question2 = new Question;
            $question2->Sondage_Id =$sondage->id;
            $question2->ordre = 2;
            $question2->label = $request->q_label2;
            $question2->save();
            $choix2_1 = new Choix;
            $choix2_1->Question_Id = $question2->id;
            $choix2_1->label = $request->choice2_1;
            $choix2_1->save();
            $choix2_2 = new Choix;
            $choix2_2->Question_Id = $question2->id;
            $choix2_2->label = $request->choice2_2;
            $choix2_2->save();
        }
        echo "Sondage avec le titre $request->titre sauvegardé !";
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = question::all();
        $answers = array();
        foreach($questions as $question){
            $question['answers']=answer::where('Question_id','=',$question->id)->orderBy('id','asc')->get();
        }

        //var_dump($choices);
        return view('poll_view',['questions' => $questions]);
    }

    /**
     * ADMIN: Edit a poll
     *
     * @param int $idPoll The poll to edit
     * @return \Illuminate\Http\Response
     */
    public function adminEditPoll($idPoll)
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
    public function adminDisplayPoll($idPoll)
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
    public function adminDisplayPollResults($idPoll)
    {
        $this->middleware('auth');
        return view('admin_poll_display_results', []);
    }

}
