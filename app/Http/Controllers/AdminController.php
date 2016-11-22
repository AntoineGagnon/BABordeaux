<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
	public function index()
	{
		if(!Auth::check())
			return redirect()->intended('login');

		return view('admin_view',[]);
	}


}