<?php

class TimelineController extends BaseController {

    public function getTimeline()
    {
        $this->fillSession();
        return View::make('timeline');
    }

    public static function fillSession()
    {
        Session::put('UserID', Auth::user()->UserID);
        Session::put('UserKindID', Auth::user()->UserKindID);
        Session::put('UserProfileID', Auth::user()->UserProfileID);
        Session::put('Email', Auth::user()->Email);
    }
}

?>