<?php

namespace App\Http\Controllers;

use App\guestbook_submission;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GuestbookController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //This is used to make sure the name is filled and < 255 char
        $validator = Validator::make($request->all(), [
            'text' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/guestbook')
                ->withInput()
                ->withErrors($validator);
        }

        $guestsm = new guestbook_submission();
        $guestsm->username = $request->has('username') ? $request->username : "Anonymous" ;
        $guestsm->text = $request->text;

        $guestsm->save();
        $worked = true;

        return view('guestbook_view', ['submissionWorked' => $worked]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guestbook_view');
    }

    public function adminDisplayGBResults()
    {
        if(!Auth::check())
            return redirect()->intended('login');

        $guestbook_submissions = guestbook_submission::all();

        return view('admin_guestbook_results', ['guestbook_submissions' => $guestbook_submissions ]);
    }

    public function destroy($id)
    {

        if(!Auth::check())
            return redirect()->intended('login');

        guestbook_submission::destroy($id);

        return redirect('admin/resultguestbook');

    }

    /**
     * ADMIN: Exports results of the guestbook to the specified format
     *
     * @param Format of the file exported (PDF or Excel)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminExportGuestBookResults($format)
    {
        if (!Auth::check())
            return redirect()->intended('login');

        $guestbook_submission = guestbook_submission::select('created_at AS Date', 'username AS Auteur', 'text AS Message')->get();

        // Generate and return the spreadsheet
        $spreadsheet = Excel::create('resultats_livre_d_or', function ($excel) use ($guestbook_submission) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle("Résultats livre d'or");
            $excel->setCreator('MBA')->setCompany('Musée des Beaux-Arts, Bordeaux');
            $excel->setDescription("Fichier contenant les résultats du livre d'or");

            // Build the spreadsheet, passing in the array
            $excel->sheet('sheet1', function ($sheet) use ($guestbook_submission) {
                $sheet->setStyle(array(
                    'font' => array(
                        'name' => 'Calibri',
                        'size' => 16,
                    )
                ));
                //$sheet->fromArray($guestbook_submission);
                $sheet->loadView('admin_guestbook_results')->with('guestbook_submissions',$guestbook_submission);
            });


        });

        $spreadsheet->download('xlsx');
    }
}
