<?php

class AuthController extends BaseController {

    public function getFacebookLogin($auth=null)
    {
    	if($auth == 'auth')
    	{
    		try
    		{
    		Hybrid_Endpoint::process();
    		}
    		catch(Exception $e)
    		{
    		return Redirect::to('fbauth');
    		}
    	return;
    	}
    	$oauth = new Hybrid_Auth(app_path(). '/config/fb_auth.php');
    	$provider = $oauth->authenticate('Facebook');
    	$profile = $provider->getUserProfile();
    	return var_dump($profile);
    }
}