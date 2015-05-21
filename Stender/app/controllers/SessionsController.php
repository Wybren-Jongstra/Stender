<?php

class SessionsController extends BaseController {

	public function create()
	{
		return View:: make('sessions.create');
	}

	public function store()
	{
		// $userdata = Input::only(['Email', 'Password']);
			$userdata = array(
					'Email' 	=> Input::get('Email'),
					'password' 	=> Input::get('Password')
				);
			print_r($userdata);

				


		if (Auth::attempt($userdata))
		{
			return Auth::User();
		}
		else
		{
			return 'Failed';
		}
	}
}