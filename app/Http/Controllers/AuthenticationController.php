<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
	public function authenticate()
	{
		if(Auth::attempt(['username' => $username, 'passwordHash' => $password])) {

			return redirect()->intended('/admin/');
		}
	}

	public function 
}