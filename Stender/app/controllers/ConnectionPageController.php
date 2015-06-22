<?php

class ConnectionPageController extends BaseController {

    public function getConnectionView()
    {
        $connections = $this->getConnections();

        return View::make('connection')->with('connections', $connections);
    }

    /**
     * Get the connections of an user.
     * @return array
     */
    public function getConnections()
    {
        $usrID = User::where('UserProfileID', '=', Session::get('UserID'))->first();

        // ConnectionStatusID = 2 => Approved
        $connectionsFrom = Connection::where('ConnectionStatusID', '=', 2)->where('FromUserID', '=', $usrID->UserID)->get();
        $connectionsFor = Connection::where('ConnectionStatusID', '=', 2)->where('ForUserID', '=', $usrID->UserID)->get();

        $connectionsFromArray = array();
        $itemfrom = 0;
        foreach ($connectionsFrom as $from) {
            $userProfile = UserProfile::where('UserProfileID', '=', $from->ForUserID)->firstOrFail();
            $connectionsFromArray[$itemfrom][] = $userProfile->ProfileUrlPart;
            $connectionsFromArray[$itemfrom][] = $userProfile->PhotoUrl;
            $connectionsFromArray[$itemfrom][] = $userProfile->DisplayName;
            $connectionsFromArray[$itemfrom][] = $from->ForUserID;
            $connectionsFromArray[$itemfrom][] = $from->ConnectionID;
            $itemfrom++;
        }

        $connectionsForArray = array();
        $itemfor = 0;
        foreach ($connectionsFor as $for) {
            $userProfile = UserProfile::where('UserProfileID', '=', $for->FromUserID)->firstOrFail();
            $connectionsForArray[$itemfor][] = $userProfile->ProfileUrlPart;
            $connectionsForArray[$itemfor][] = $userProfile->PhotoUrl;
            $connectionsForArray[$itemfor][] = $userProfile->DisplayName;
            $connectionsForArray[$itemfor][] = $for->FromUserID;
            $connectionsForArray[$itemfor][] = $for->ConnectionID;
            $itemfor++;
        }

        return array_merge($connectionsForArray, $connectionsFromArray);
    }

    /**
     * Remove a connected user.
     * @param $connectionID
     * @return mixed
     */
    public function removeConnection($connectionID)
    {
        if( Connection::where('ConnectionID', '=', $connectionID)->where('ForUserID', '=', Session::get('UserID'))->exists() ||
            Connection::where('ConnectionID', '=', $connectionID)->where('FromUserID', '=', Session::get('UserID'))->exists() )
        {
            $connect = Connection::where('ConnectionID', '=', $connectionID)->first();
            $connect->delete();
            return Redirect::to('/connections');
        }
        else
        {
            return Redirect::to('/connections');
        }
    }

    /**
     * Get the Stender Score of a connection by his UserProfileID
     * @param $usrProfID
     * @return mixed
     */
    public static function getStenderScore($usrProfID)
    {
        $usrID = User::where('UserProfileID', '=', $usrProfID)->first();

        // ConnectionStatusID = 2 => Approved
        $stenderScoreForPrTrue = UserVote::where('Upvote', '=', 1)->where('ForUserID', '=', $usrID->UserID)->count();
        $stenderScoreForPrFalse = UserVote::where('Upvote', '=', 0)->where('ForUserID', '=', $usrID->UserID)->count();
        $stenderScore = $stenderScoreForPrTrue - $stenderScoreForPrFalse;
        return $stenderScore;
    }

    /**
     * Get the last login of a user by UserProfileID
     * @param $userProfID
     * @return string
     */
    public static function getLastLogin($userProfID)
    {
        $user = User::where('UserProfileID', '=', $userProfID)->first();
        return \Carbon\Carbon::createFromTimeStamp(strtotime($user->LastLogin))->diffForHumans();
    }
}
