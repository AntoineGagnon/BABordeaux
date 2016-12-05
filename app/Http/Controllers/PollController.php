<?php
namespace App\Http\Controllers;

use App\answer;
use App\choice;
use App\Choix;
use App\Http\Requests;
use App\question;
use App\question_group;
use App\Reponse;
use App\Sondage;
use App\guestbook_submission;
use App\submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Khill\Lavacharts\Lavacharts as Lava;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
     * @return \Illuminate\Http\Response
     */
    public function adminEditPoll()
    {
        if(!Auth::check())
            return redirect()->intended('login');


        $questionGroups = question_group::all();

        //fetch all question from database.
        $questions = question::all();

        //if a questionGroup is empty (i.e. has no question into) delete this questionGroup from the database.
        foreach($questionGroups as $questionGroup){
            if(question::where('question_group_id',$questionGroup->id)->count() == 0)
            {
                $questionGroup->destroy($questionGroup->id);
            }
        }

        return view('admin_poll_edit_view', ['questionGroups' => $questionGroups, 'questions' => $questions, ]);
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

    /**
     * ADMIN: Exports results of the guestbook to the specified format
     *
     * @param Format of the file exported (PDF or Excel)
     */
    public function adminExportGuestBookResults($format){

        $guestbook_submission = guestbook_submission::select('created_at AS Date','username AS Auteur','text AS Message')->get();

        // Generate and return the spreadsheet
        $spreadsheet = Excel::create('resultats_livre_d_or', function($excel) use ($guestbook_submission) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle("Résultats livre d'or");
            $excel->setCreator('MBA')->setCompany('Musée des Beaux-Arts, Bordeaux');
            $excel->setDescription("Fichier contenant les résultats du livre d'or");

            // Build the spreadsheet, passing in the array
            $excel->sheet('sheet1', function($sheet) use ($guestbook_submission) {
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  16,
                    )
                ));
                $sheet->fromArray($guestbook_submission);
                //$sheet->loadView('admin_guestbook_results')->with('guestbook_submissions',$guestbook_submission);
            });


        });
        if($format == "pdf")
            $spreadsheet->download('pdf');
        else
            $spreadsheet->download('xlsx');
    }

    /**
     * ADMIN: Exports results of the poll to the specified format
     * @param Format of the file exported (PDF or Excel)
     */
    public function adminExportPollResults($format){


        // Generate and return the spreadsheet
        $spreadsheet = Excel::create('resultats_sondage', function($excel) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Résultats sondage');
            $excel->setCreator('MBA')->setCompany('Musée des Beaux-Arts, Bordeaux');
            $excel->setDescription('Fichier contenant les résultats du sondage public');

            // Build the spreadsheet, passing in the array
            $excel->sheet('sheet1', function($sheet) {
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  16,
                    )
                ));

                $sheet->loadView('admin_poll_display_results');
            });


        });
        if($format == "pdf")
            $spreadsheet->download('pdf');
        else
            $spreadsheet->download('xlsx');
    }

}
