<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
	public function index()
	{
		return view('login_view',[]);
	}

	public function authenticate()
	{
		if (Auth::attempt(['username' => 'admin', 'password' => Input::get('_password')])) {
            return redirect()->intended('admin');
        }
        else
        {
        	return redirect()->intended('login');
        }
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->intended('/');
	}
}