<?php

class SessionsController extends BaseController {

	public function create()
	{
		if(Auth::check())
		{
			return Redirect::to('/timeline');
		}
		return Redirect::to('/');
	}

	public function store()
	{
		
		

		$input = Input::all();

		//rules to validate input
		$rules = array(
			'emailLogin' => 'required|email',
			'password' => 'required'
		);

		//check validation
		$v = Validator::make($input, $rules);

		//if validator passes then try to login
		if($v->passes())
		{

			//get the input userdata
				$userdata = array(
						'Email' 	=> Input::get('emailLogin'),
						'password' 	=> Input::get('password')
					);
			
			//attempt to login
			if (Auth::attempt($userdata))
			{
				Auth::user()->LastLogin = new DateTime;
				Auth::user()->RememberToken = $input['_token'];
    			Auth::user()->save();

				//login succesfull move along
				return Redirect::to('/timeline');
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

	public function destroy()
	{
		Auth::logout();

		return Redirect::to('/');
	}
}