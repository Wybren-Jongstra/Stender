<?php

class LoginController extends BaseController {

    /**
     * Show the profile for the given user.
     */
    public function showLoginPage()
	{
		$test = 'hallo';
		$testName = 'User';
		return View::make('home', array('name' => 'testName'));
	}

}

?>