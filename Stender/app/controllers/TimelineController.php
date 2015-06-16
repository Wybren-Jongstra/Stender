<?php

class TimelineController extends BaseController {

    /**
     * Create the view timeline
     * @return mixed
     */
    public function getTimeline()
    {
        $this->fillSession();

        $userprofile = UserProfile::find(Auth::user()->UserProfileID);

        $connections = $this->getNumberConnections($userprofile->UserProfileID);
        $stenderScore = $this->getStenderScore($userprofile->UserProfileID);
        $connectProfiles = $this->getConnections($userprofile->UserProfileID);
        $statusupdates = $this->getStatusUpdates($connectProfiles);

        return View::make('timeline')->with('userProfile', $userprofile)->with('stenderScore', $stenderScore)->with('connections', $connections)
            ->with('connectionProfiles', $connectProfiles)->with('statusUpdates', $statusupdates);
    }

    /**
     * Get the connections of an user by the UserProfileID.
     * This function gets only the connections of an user which are approved(ConnectionStatusID = 2).
     * @param $usrProfID
     * @return array
     */
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
            $connectionsFromArray[$itemfrom][] = $from->ForUserID;
            $itemfrom++;
        }

        $connectionsForArray = array();
        $itemfor = 0;
        foreach ($connectionsFor as $for) {
            $userProfile = UserProfile::where('UserProfileID', '=', $for->FromUserID)->firstOrFail();
            $connectionsForArray[$itemfor][] = $userProfile->ProfileUrlPart;
            $connectionsForArray[$itemfor][] = $userProfile->DisplayName;
            $connectionsForArray[$itemfor][] = $for->FromUserID;
            $itemfor++;
        }

        return array_merge($connectionsForArray, $connectionsFromArray);
    }

    /**
     * Get the number of connections of a user by UserProfileID.
     * @param $usrProfID
     * @return mixed
     */
    public function getNumberConnections($usrProfID)
    {
        $usrID = User::where('UserProfileID', '=', $usrProfID)->first();

        // ConnectionStatusID = 2 => Approved
        $connectionsFrom = Connection::where('ConnectionStatusID', '=', 2)->where('FromUserID', '=', $usrID->UserID)->count();
        $connectionsFor = Connection::where('ConnectionStatusID', '=', 2)->where('ForUserID', '=', $usrID->UserID)->count();
        $connections = $connectionsFor + $connectionsFrom;
        return $connections;
    }

    /**
     * Get the Stender score of a user by UserProfileID
     * @param $usrProfID
     * @return mixed
     */
    public function getStenderScore($usrProfID)
    {
        $usrID = User::where('UserProfileID', '=', $usrProfID)->first();

        // ConnectionStatusID = 2 => Approved
        $stenderScoreForPrTrue = UserVote::where('Upvote', '=', 1)->where('ForUserID', '=', $usrID->UserID)->count();
        $stenderScoreForPrFalse = UserVote::where('Upvote', '=', 0)->where('ForUserID', '=', $usrID->UserID)->count();

        // Calculate the stenderscore
        $stenderScore = $stenderScoreForPrTrue - $stenderScoreForPrFalse;
        return $stenderScore;
    }

    /**
     * Get the status updates of all connected users by the connections of a user.
     * @param $connections
     * @return mixed
     */
    public function getStatusUpdates($connections)
    {
        $userIdArray = array();
        foreach($connections as $connection)
        {
            $userIdArray[] = $connection[2];
        }
        $userIdArray[] = Session::get('UserID');

        $friends_status_updates = StatusUpdate::whereIn('UserID', $userIdArray)->orderBy('DateCreated', 'DESC')->get();
        return $friends_status_updates;
    }

    /**
     * Save the posted status update, with or without image, in the database.
     * @return mixed
     */
    public function postStatus()
    {
        $post = new StatusUpdate();
        $post->UserID = Session::get('UserID');
        $post->DateCreated = Carbon\Carbon::now();
        $post->Text = Input::get('userStatus');

        $destinationPath = '';
        $filename        = '';

        if (Input::hasFile('statusImage'))
        {
            // Build the input for our validation
            $input = array('image' => Input::file('statusImage'));

            // Within the ruleset, make sure we let the validator know that this
            // file should be an image
            $rules = array(
                'image' => 'image'
            );

            // Now pass the input and rules into the validator
            $validator = Validator::make($input, $rules);

            // Check to see if validation fails or passes
            if ($validator->fails())
            {
                // Redirect with a helpful message to inform the user that
                // the provided file was not an adequate type
                return Redirect::to('/timeline')->withErrors('Upload een afbeelding.');
            }
            else
            {
                $file            = Input::file('statusImage');
                $destinationPath = 'uploads/';
                $filename        = Session::get('UserID') . '_' . str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $post->ImageUrlPart = $destinationPath . $filename;
            }
        }

        $post->save();

        return Redirect::to('/');
    }

    /**
     * Delete a status update of a user by StatusUpdateID
     * @param $statusID
     * @return mixed
     */
    public function deleteStatus($statusID)
    {
        $statusUpdate = StatusUpdate::where('StatusUpdateID', '=', $statusID)->firstOrFail();
        $statusUpdate->delete();
        return Redirect::to('/');
    }

    /**
     * Get the
     * @param $timestamp
     * @return string
     */
    public static function getTimeAgo($timestamp)
    {
        return \Carbon\Carbon::createFromTimeStamp(strtotime($timestamp))->diffForHumans();
    }

    public static function getUserProfileByUserID($userID)
    {
        $user = User::where('UserProfileID', '=', $userID)->first();
        $userProfile = UserProfile::where('UserProfileID', '=', $user->UserProfileID)->first();
        return $userProfile;
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
