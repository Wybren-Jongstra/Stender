<?php

class HomeController extends BaseController {
	
    // HOME PAGE
    public function getIndex()
    {
        if (Auth::check())
        {
            return View::make('timeline');
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

		//rules to validate input
		$rules = array(
			'fullName' 	=> 'required',
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
				$password = $input['password'];
				$password = Hash::make($password);
				$user = new User();
				//$user->fullName = $input['fullName'];
				$user->Email = $input['email'];
				$user->Password = $password;
				$user->UserKindID = 2;
				$user->DateCreated = Carbon\Carbon::now();
				$user->save();
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
}

?>