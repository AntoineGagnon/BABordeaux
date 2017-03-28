<?php

namespace App\Http\Controllers;

use App\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RuleController extends Controller
{
    public function index(){

        if (!Auth::check())
            return redirect()->intended('login');
        $rules = Rule::all();
        return view('rules_view', ['rules'=>$rules]);
    }
}
