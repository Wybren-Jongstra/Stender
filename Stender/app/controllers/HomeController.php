<?php

class HomeController extends BaseController {
	
	public function getIndex()
	{
		return View::make('home');
	}

	public function postRegister()
	{
		//get input
		$input = Input::all();

		//rules to validate input
		$rules = array(
			'fullName' 	=> 'required',
			'email'	 	=> 'required|email|unique:USER',
			'password' 	=> 'required'
		);

		//check validation
		$v = Validator::make($input, $rules);

		//store data in user object and save to database
		if($v->passes())
		{
			$password = $input['password'];
			$password = Hash::make($password);
			$user = new User();
			//$user->fullName = $input['fullName'];
			$user->Email = $input['email'];
			$user->Password = $password;
			$user->UserKindID = 1;
			$user->DateCreated = Carbon\Carbon::now();
			$user->remember_token = $input['_token'];
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