<?php

class SessionsController extends BaseController {

	public function create()
	{
		return View:: make('sessions.create');
	}

	public function store()
	{
		$userdata = Input::only(['Email', 'Password']);
		/*$userdata = array(
				'Email' 	=> Input::get('Email'),
				'Password' 	=> Hash::make(Input::get('Password'))
			);*/
		// print_r($userdata);

		if (Auth::attempt(Input::only('Email', 'Password')))
		{
			return Auth::User();
		}
		else
		{
			return 'Failed';
		}
	}
}