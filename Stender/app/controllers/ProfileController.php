<?php

class ProfileController extends BaseController {

    public function getProfile()
    {
        //$this->fillSession();

        $userprofile = UserProfile::find(Auth::user()->UserProfileID);

        $data = array(
        'firstname'  => $userprofile->FirstName,
        'profileID' => $userprofile->UserProfileID,
        );

        return View::make('profile')->with('data', $data);
    }

    public static function fillSession()
    {
        Session::put('UserID', Auth::user()->UserID);
        Session::put('UserKindID', Auth::user()->UserKindID);
        Session::put('UserProfileID', Auth::user()->UserProfileID);
        Session::put('Email', Auth::user()->Email);

        
    }
}
