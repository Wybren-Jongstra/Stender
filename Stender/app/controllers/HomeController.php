<?php

class HomeController extends BaseController {
	
	public function getIndex()
	{
		return View::make('home');
	}

	public function postRegister()
	{
		//haal de input op
		$input = Input::all();

		print_r($input);
		//regels waar de input aan moet voldoen
		$rules = array(
			'fullName' 	=> 'required',
			'email'	 	=> 'required|email|unique:USER',
			'password' 	=> 'required'
		);

		//checken of de input aan de regels voldoet
		$v = Validator::make($input, $rules);

		//als het voldoet dan de gegevens in een user object stoppen en deze opslaan
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

	public function postLogin()
	{
		//input ophalen
		$input = Input::all();

		//regels voor de input
		$rules = array(
			'emailLogin' => 'required|email',
			'password' => 'required'
		);

		//checken of de input aan de regels voldoet
		$v = Validator::make($input, $rules);

		//als het voldoet dan de gegevens in een user object stoppen en deze opslaan
		if($v->passes())
		{

			$userdata = array(
				'Email' 	=> Input::get('emailLogin'),
				'Password' 	=> Hash::make(Input::get('password'))
			);

			//proberen in te loggen
			if(Auth::attempt($userdata))
			{
				//inloggen gelukt
				return Redirect::to('timeline');
			}
			else
			{
				return Redirect::to('/')->withInput()->with('wrongCred', 'Verkeerde gebruikersnaam en/of wachtwoord!');
			}
		}
		else
		{
			return Redirect::to('/')->withInput()->withErrors($v);
		}


	}
}

?>