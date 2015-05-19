<?php

class HomeController extends BaseController {
	
	public function getIndex()
	{
		return View::make('home');
	}

	public function postRegister()
	{
		$input = Input::all();

		$rules = array('inputName' => 'required', 'inputEmail' => 'required|unique:users|email', 'password' => 'required');

		$v = Validator::make($input, $rules);

		if($v->passes())
		{
			$password = $input['password'];
			$password = hash::make($password);
			$user = new User();
			$user->username = $input['inputName'];
			$user->inputEmail = $input['inputEmail'];
			$user->password = $password;

			return Redirect::to('/');

		}
		else
		{
			return Redirect::to('/')->withInput()->withErrors($v);
		}
		
	}
}

?>