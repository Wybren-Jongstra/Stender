<?php

class TimelineController extends BaseController {

    public function getTimeline()
    {
        $this->fillSession();

        $userprofile = UserProfile::find(Auth::user()->UserProfileID);

        $connections = $this->getNumberConnections($userprofile->UserProfileID);
        $stenderScore = $this->getStenderScore($userprofile->UserProfileID);
        $connectProfiles = $this->getConnections($userprofile->UserProfileID);

        return View::make('timeline')->with('userProfile', $userprofile)->with('stenderScore', $stenderScore)->with('connections', $connections)
            ->with('connectionProfiles', $connectProfiles);
    }

    public function getConnections($usrProfID)
    {
        $usrID = User::where('UserProfileID', '=', $usrProfID)->first();

        // ConnectionStatusID = 2 => Approved
        $connectionsFrom = Connection::where('ConnectionStatusID', '=', 2)->where('FromUserID', '=', $usrID->UserID)->get();
        $connectionsFor = Connection::where('ConnectionStatusID', '=', 2)->where('ForUserID', '=', $usrID->UserID)->get();

        $connectionsFromArray = array();
        $itemfrom = 0;
        foreach ($connectionsFrom as $from) {
            $userProfile = UserProfile::where('UserProfileID', '=', $from->ForUserID)->firstOrFail();
            $connectionsFromArray[$itemfrom][] = $userProfile->ProfileUrlPart;
            $connectionsFromArray[$itemfrom][] = $userProfile->DisplayName;
            $itemfrom++;
        }

        $connectionsForArray = array();
        $itemfor = 0;
        foreach ($connectionsFor as $for) {
            $userProfile = UserProfile::where('UserProfileID', '=', $for->FromUserID)->firstOrFail();
            $connectionsForArray[$itemfor][] = $userProfile->ProfileUrlPart;
            $connectionsForArray[$itemfor][] = $userProfile->DisplayName;
            $itemfor++;
        }

        return array_merge($connectionsForArray, $connectionsFromArray);
    }

    public function getNumberConnections($usrProfID)
    {
        $usrID = User::where('UserProfileID', '=', $usrProfID)->first();

        // ConnectionStatusID = 2 => Approved
        $connectionsFrom = Connection::where('ConnectionStatusID', '=', 2)->where('FromUserID', '=', $usrID->UserID)->count();
        $connectionsFor = Connection::where('ConnectionStatusID', '=', 2)->where('ForUserID', '=', $usrID->UserID)->count();
        $connections = $connectionsFor + $connectionsFrom;
        return $connections;
    }

    public function getStenderScore($usrProfID)
    {
        $usrID = User::where('UserProfileID', '=', $usrProfID)->first();

        // ConnectionStatusID = 2 => Approved
        $stenderScoreForPrTrue = UserVote::where('Upvote', '=', 1)->where('ForUserID', '=', $usrID->UserID)->count();
        $stenderScoreForPrFalse = UserVote::where('Upvote', '=', 0)->where('ForUserID', '=', $usrID->UserID)->count();
        $stenderScore = $stenderScoreForPrTrue - $stenderScoreForPrFalse;
        return $stenderScore;
    }

    public static function fillSession()
    {
        $userprofile = UserProfile::find(Auth::user()->UserProfileID);

        Session::put('UserID', Auth::user()->UserID);
        Session::put('UserKindID', Auth::user()->UserKindID);
        Session::put('UserProfileID', Auth::user()->UserProfileID);
        Session::put('Email', Auth::user()->Email);
        Session::put('ProfileUrlPart', $userprofile->ProfileUrlPart);
        Session::put('DisplayName', $userprofile->DisplayName);
    }
}
