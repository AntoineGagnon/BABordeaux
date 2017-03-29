<?php
namespace App\Http\Controllers;

use App\answer;
use App\artwork;
use App\choice;
use App\Choix;
use App\Http\Requests;
use App\question;
use App\question_group;
use App\Reponse;
use App\rule;
use App\Sondage;
use App\guestbook_submission;
use App\submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;
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
            if ($request->has('question_' . $i)) {
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
                } // Open question
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
        $artworks = artwork::where('id',5)->get();


        $questions = question::where('is_visible', 1)->get();
        foreach ($questions as $question) {
                $question['answers'] = answer::where('question_id', $question->id)->orderBy('answer_order', 'asc')->get();

        }

        return view('poll_view', ['questions' => $questions, 'artworks' => $artworks]);
    }

    /**
     * ADMIN: Edit a poll
     *
     * @return \Illuminate\Http\Response
     */
    public function adminEditPoll()
    {
        if (!Auth::check())
            return redirect()->intended('login');


        //fetch all question from database.
        $questions = question::all();

        $rules = rule::all();


        return view('admin_poll_edit_view', ['questions' => $questions, 'rules' => $rules]);
    }

    /**
     * ADMIN: Display the results of a poll
     *
     * @param int $idPoll The poll
     * @return \Illuminate\Http\Response
     */
    public function adminDisplayPollResults()
    {
        if (!Auth::check())
            return redirect()->intended('login');


        $questions = question::all();

        foreach ($questions as $question) {

            $datatable = Lava::DataTable();


            if (choice::where('question_id', $question->id)->count() != 0) { // Check only questions with answers

                switch ($question->questionType) {
                    case 'multipleChoice':
                        $totalChoices = choice::where('question_id', $question->id)->count();
                        $totalSubmissions = submission::count();

                        $question['average'] = $totalChoices / $totalSubmissions;
                    case 'singleChoice':
                        $question['answers'] = answer::where('question_id', $question->id)->get();

                        $datatable->addStringColumn('Réponses')
                            ->addNumberColumn('Nombre');

                        foreach ($question['answers'] as $answer) {
                            $count = choice::where('answer_id', $answer->id)->count();
                            $datatable->addRow([$answer->label, $count]);
                        }

                        Lava::PieChart(strval($question->id), $datatable);
                        break;
                    case 'openAnswer':
                        $question['answers'] = answer::where('question_id', $question->id)->get();
                }

            } else {
                $question['answers'] = null;
            }
        }

        return view('admin_poll_display_results', ['questions' => $questions]);
    }



    /**
     * ADMIN: Exports results of the poll to the specified format
     * @param Format of the file exported (PDF or Excel)
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminExportPollResults($format)
    {

        if (!Auth::check())
            return redirect()->intended('login');


        // Generate and return the spreadsheet
        $spreadsheet = Excel::create('resultats_sondage', function ($excel) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Résultats sondage');
            $excel->setCreator('MBA')->setCompany('Musée des Beaux-Arts, Bordeaux');
            $excel->setDescription('Fichier contenant les résultats du sondage public');

            // Build the spreadsheet, passing in the array
            $excel->sheet('sheet1', function ($sheet) {
                $sheet->setStyle(array(
                    'font' => array(
                        'name' => 'Calibri',
                        'size' => 16,
                    )
                ));

                $sheet->loadView('admin_poll_display_results');
            });


        });
        if ($format == "pdf")
            $spreadsheet->download('pdf');
        else
            $spreadsheet->download('xlsx');
    }

}
