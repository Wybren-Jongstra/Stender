<?php

class TimelineController extends BaseController {

    public function getTimeline()
    {
        $this->fillSession();

        $userprofile = UserProfile::find(Auth::user()->UserProfileID);

        $data = array(
        'firstname'  => $userprofile->FirstName,
        'ProfileUrlPart' => $userprofile->ProfileUrlPart,
        );

        return View::make('timeline')->with('data', $data);
    }

    public static function fillSession()
    {
        Session::put('UserID', Auth::user()->UserID);
        Session::put('UserKindID', Auth::user()->UserKindID);
        Session::put('UserProfileID', Auth::user()->UserProfileID);
        Session::put('Email', Auth::user()->Email);

        
    }
}
