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
			
			// Custom attempt to login
            // Send no remember token when the user is not validated to login.
			if (Auth::validate($userdata))
			{
                // Check if account is activated
				if(Auth::getLastAttempted()->Activated != '1')
    			{
    				return Redirect::to('/')->withInput()->with('wrongCred', 'Je account is nog niet geactiveerd!');
    			}
    			else
	    		{
                    // User is fully validated so log the user in.
                    // The value of a checkbox is only sent when it is 'on'. So there is no need to use the actual value.
                    Auth::login(Auth::getLastAttempted(), Input::has('staySignedIn'));

					Auth::user()->LastLogin = new DateTime;
	    			Auth::user()->save();

					// Login successful move along
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
