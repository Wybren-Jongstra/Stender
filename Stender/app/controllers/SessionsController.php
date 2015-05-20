<?php

class SessionsController extends BaseController {

	public function create()
	{
		return View:: make('sessions.create');
	}

	public function store()
	{
		$userdata = array(
				'Email' 	=> Input::get('Email'),
				'Password' 	=> Hash::make(Input::get('Password'))
			);
		print_r($userdata); 

		if(Auth::attempt(array('Email'	=> Input::get('Email'), 'Password' 	=> Input::get('Password'))))
		{
			return Auth::User();
		}
		else
		{
		return 'Failed';
		}
	}
}