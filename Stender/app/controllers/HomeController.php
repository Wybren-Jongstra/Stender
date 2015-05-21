<?php

class HomeController extends BaseController {
	
	public function getIndex()
	{
		return View::make('home');
	}

	public function postRegister()
	{

		Validator::extend('contains', function($attribute, $value, $parameters)
		{
		    // check email address
		    $words = array('stenden.com', 'student.stenden.com');
		    foreach ($words as $word)
		    {
		        if (stripos($value, $word) !== true) 
		        {
		        	return true;
		    	}
		    }
		    return false;
		});

		//get input
		$input = Input::all();

		//rules to validate input
		$rules = array(
			'fullName' 	=> 'required',
			'email'	 	=> 'required|email|unique:USER|contains',
			'password' 	=> 'required'
		);

		//check validation
		$v = Validator::make($input, $rules);
        $v->setAttributeNames(Lang::get('attributes.user'));

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