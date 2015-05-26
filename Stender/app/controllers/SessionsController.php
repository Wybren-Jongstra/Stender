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
			'password' => 'required',
            'staySignedIn' => 'boolean', // Not required because the value of a checkbox is not sent when it isn't 'on'.
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
			
			// Attempt to login
            // The value of a checkbox is only sent when it is 'on'. So there is no need to use the actual value.
			if (Auth::attempt($userdata, Input::has('staySignedIn')))
			{
				if(Auth::user()->Activated != '1')
    			{
    				Auth::logout();
    				return Redirect::to('/')->withInput()->with('wrongCred', 'Je account is nog niet geactiveerd!');	
    			}
    			else
	    		{
					Auth::user()->LastLogin = new DateTime;
	    			Auth::user()->save();

					//login succesfull move along
					return Redirect::to('/timeline');
				}
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

	public function verify($token)
    {
        if( ! $token)
        {
            throw new InvalidTokenException;
        }

        $user = User::where('ActivationToken', '=', $token)->first();

        if($user->Activated === 1)
        {
			return Redirect::to('/')->withInput()->with('wrongCred', 'Account is al geactiveerd!');
        }

        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->Activated = 1;
        $user->save();

        return Redirect::to('/')->withInput()->with('activated', 'Account is geactiveerd! Je kunt nu inloggen.');
	}
}
