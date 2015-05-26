<?php

class HomeController extends BaseController {
	
    // HOME PAGE
    public function getIndex()
    {
        if (Auth::check())
        {
            return Redirect::to('timeline');
        }
        else
        {
            return View::make('home');
        }
    }

	public function postRegister()
	{

		//get input
		$input = Input::all();

		$profileUrl = '';
		$displayName = '';


		//rules to validate input
		$rules = array(
			'firstname' => 'required',
			'surname' 	=> 'required',
			'email'	 	=> 'required|email|unique:USER',
			'password' 	=> 'required'

		);

		//check validation
		$v = Validator::make($input, $rules);
        $v->setAttributeNames(Lang::get('attributes.user'));

		//store data in user object and save to database
		if($v->passes())
		{
			$email = $input['email'];
			if(ends_with($email, 'stenden.com'))
			{
				//$verifier = App::make('validation.presence');
				if($input['surnamePrefix'] == '')
				{
					$profileUrl = $input['firstname'].'.'.$input['surname'];
					$displayName = $input['firstname'].' '.$input['surname'];
				}
				else
				{
					$profileUrl = $input['firstname'].'.'.$input['surnamePrefix'].'.'.$input['surname'];
					$displayName = $input['firstname'].' '.$input['surnamePrefix'].' '.$input['surname'];
				}
				//$verifier->setConnection('stender');


					$confirmationCode = str_random(64);

					$password = $input['password'];
					$password = Hash::make($password);
					$user = new User();
					//$user->fullName = $input['fullName'];
					$user->Email = $input['email'];
					$user->ActivationToken = $confirmationCode;
					$user->Password = $password;
					$user->UserKindID = 2;
					$user->DateCreated = Carbon\Carbon::now();
					

					$userprofile = new UserProfile();
					$userprofile->FirstName = $input['firstname'];
					$userprofile->SurnamePrefix = $input['surnamePrefix'];
					$userprofile->Surname = $input['surname'];
					$userprofile->ProfileUrlPart = $this->getProfileUrlPart($profileUrl);
					$userprofile->Displayname = $displayName;

					$userprofile->save();

					$user->UserProfileID = $userprofile->UserProfileID;
					$user->save();

					// Mail::send('emails.Welcome', array('confirmationCode'=> $confirmationCode), function($message) {
			  //   		$message->to($input['email'], $input['firstname'])->subject('Please activate your account!');
					// });

					Mail::send('emails.Welcome', array('confirmationCode'=> $confirmationCode), function($message) {
			    		$message->to('buntraymon@gmail.com', 'John Doe')->subject('Please activate your account!');
					});
			}
			else
			{
				return Redirect::to('/')->withInput()->withErrors('Je moet registreren met een Stenden e-mailadres.');
			}

			return Redirect::to('/')->withSuccess( 'Registreren gelukt! Je krijgt z.s.m. een mail om je account te activeren.' );

		}
		else
		{
			return Redirect::to('/')->withInput()->withErrors($v);
		}
		
	}

	private function getProfileUrlPart($profileUrlPart, $increment = 0)
	{
		if($increment > 0)
		{
			$newProfileUrlPart = $profileUrlPart . $increment;
		}
		else
		{
			$newProfileUrlPart = $profileUrlPart;
		}

		$valPart = Validator::make(
			    ['ProfileUrlPart' => $newProfileUrlPart],
			    ['ProfileUrlPart' => 'unique:USER_PROFILE,ProfileUrlPart']
		);

		if($valPart->fails())
		{	
			++$increment;
			return $this->getProfileUrlPart($profileUrlPart, $increment);
		}
		else
		{
			return $newProfileUrlPart;
		}
	}
}