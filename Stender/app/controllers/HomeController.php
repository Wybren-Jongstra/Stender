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

    /**
     * Register an user and check if the input values are valid.
     * @return mixed
     */
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
                $userprofile->ProfileUrlPart = self::getProfileUrlPart($profileUrl);
                $userprofile->Displayname = $displayName;

                $userprofile->save();

                $user->UserProfileID = $userprofile->UserProfileID;
                $user->save();
                // Mail::send('emails.Welcome', array('confirmationCode'=> $confirmationCode), function($message) {
          //   		$message->to($input['email'], $input['firstname'])->subject('Please activate your account!');
                // });

                Mail::send('emails.welcome', array('confirmationCode'=> $confirmationCode), function($message) {
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
			return Redirect::to('/')->withInput()->withErrors('Vul alle velden in.');
		}
	}

    // Made public static for use in USERTableSeeder
    public static function getProfileUrlPart($profileUrlPart)
    {
        // Get results
        $results = DB::table('USER_PROFILE')->select('ProfileUrlPart')->where('ProfileUrlPart', 'LIKE', $profileUrlPart . '%')->get();

        // Convert results to an array
        $profileUrlParts = array();
        for ($i = 0, $length = count($results); $i < $length; $i++)
        {
            $profileUrlParts[$i] = $results[$i]->ProfileUrlPart;
        }

        // First check the given ProfileUrlPart
        $newProfileUrlPart = $profileUrlPart;

        // Check if ProfileUrlPart already exists
        // If not generate an unique ProfileUrlPart
        $increment = 0;
        while(in_array($newProfileUrlPart, $profileUrlParts))
        {
            $increment++;
            $newProfileUrlPart = $profileUrlPart . $increment;
        }

        return $newProfileUrlPart;
    }

}