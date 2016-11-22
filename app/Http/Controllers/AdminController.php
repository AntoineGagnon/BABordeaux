<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	public function index()
	{
		if(!Auth::check())
			return redirect()->intended('login');

		return view('admin_view',[]);
	}

	public function changePassword()
	{
		if(!Auth::check())
			return redirect()->intended('login');

		return view('admin_update_password_view');
	}

	public function postPasswordChange()
	{
		if(!Auth::check())
			return redirect()->intended('login');

		$password = Input::get('_password');

		if($password == Input::get('_passwordConfirmation') && strlen($password) <= 50 && strlen($password) > 0)
		{
			DB::table('users')->where('username', 'admin')->update(['password' => Hash::make($password)]);

			return redirect()->action('AdminController@changePassword')->with(['message' => 'Mot de passe modifié']);
		}
		else if (strlen($password) == 0)
		{
			return redirect()->action('AdminController@changePassword')->with(['message' => 'Veuillez saisir un mot de passe']);
		}
		else if (strlen($password) > 50)
		{
			return redirect()->action('AdminController@changePassword')->with(['message' => 'Le mot de passe est trop long (max. 50 caractères)']);
		}
		else
		{
			return redirect()->action('AdminController@changePassword')->with(['message' => 'Les mots de passe ne correspondent pas.']);
		}
	}


}