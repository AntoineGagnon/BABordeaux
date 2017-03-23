<?php

namespace App\Http\Controllers;

use App\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RuleController extends Controller
{
    public function index(){

        $rules = Rule::all();
        return view('rules_view', ['rules'=>$rules]);
    }
}
