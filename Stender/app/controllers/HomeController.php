<?php

class HomeController extends BaseController {
	
	public function getIndex()
	{
		return View::make('home');
	}

	public function postRegister()
	{
		$input = Input::all();

		$rules = array('fullName' => 'required', 'email' => 'required|email|unique:USER', 'password' => 'required');

		$v = Validator::make($input, $rules);

		if($v->passes())
		{
			$password = $input['password'];
			$password = Hash::make($password);
			$user = new User();
			//$user->fullName = $input['fullName'];
			$user->Email = $input['email'];
			$user->Password = $password;
			$user->UserKindID = 1;
			$user->DateCreated = Carbon\Carbon::now();;
			$user->save();

			return Redirect::to('/')->withSuccess( 'Registreren gelukt! Je krijgt een mail om je account te activeren.' );

		}
		else
		{
			return Redirect::to('/')->withInput()->withErrors($v);
		}
		
	}
}

?>