<?php

class ProfileController extends BaseController {

    public function getProfile($profileUrl)
    {
        $profileData = $this->getData($profileUrl);
        $connectionSum = $this->getNumberConnections($profileData['UserProfileID']);
        $stenderScore = $this->getStenderScore($profileData['UserProfileID']);
    	$getCheckConnection = $this->checkForConnection($profileData['UserProfileID']);
        $interests = $this->getInterests($profileData['UserProfileID']);
        $skills = $this->getSkills($profileData['UserProfileID']);
        $places = $this->getHashTags($profileData['UserProfileID']);
        $reviews = $this->getReviews($profileData['UserProfileID']);
        return View::make('profile')->with('data', $this->getData($profileUrl))->with('interests', $interests)->with('skills', $skills)
            ->with('places', $places)->with('reviews', $reviews)->with('connectionState', $getCheckConnection)->with('connections', $connectionSum)
            ->with('stenderScore', $stenderScore);
    }

    public function editprofile($profileUrl)
    {
        return View::make('editProfile')->with('data', $this->getData($profileUrl));
    }

    public function getData($profileUrl)
    {
        $userprofile = UserProfile::where('ProfileUrlPart', '=', $profileUrl)->firstOrFail();

        $data = array(
        'UserProfileID'  => $userprofile->UserProfileID,
        'DateUpdated' => $userprofile->DateUpdated,
        'ProfileUrlPart'  => $userprofile->ProfileUrlPart,
        'DisplayName'  => $userprofile->DisplayName,
        'PhotoUrl' => $userprofile->PhotoUrl,
        'FirstName'  => $userprofile->FirstName,
        'Surname'  => $userprofile->Surname,
        'Prefix' => $userprofile->Prefix,
        'MiddleName'  => $userprofile->MiddleName,
        'SurnamePrefix'  => $userprofile->SurnamePrefix,
        'Suffix' => $userprofile->Suffix,
        'Birthday'  => date("d-m-Y", strtotime($userprofile->Birthday)),
        'GenderID'  => $userprofile->GenderID,
        'SexualOrientation' => $userprofile->SexualOrientation,
        'StreetName'  => $userprofile->StreetName,
        'HouseNumber'  => $userprofile->HouseNumber,
        'HouseNumberSuffix' => $userprofile->HouseNumberSuffix,
        'Zip'  => $userprofile->Zip,
        'City'  => $userprofile->City,
        'Country' => $userprofile->Country,
        'AlternativeEmail'  => $userprofile->AlternativeEmail,
        'Education'  => $userprofile->Education,
        );

        return $data;
    }

    public function setUpVote()
    {
        $usrID = User::where('UserProfileID', '=', Input::get('id'))->firstOrFail();
        if( UserVote::where('ForUserID', '=', Session::get('UserID'))->where('FromUserID', '=', $usrID->UserID)->exists() )
        {
            $userVote = UserVote::where('ForUserID', '=', Session::get('UserID'))->where('FromUserID', '=', $usrID->UserID)->first();
            $userVote->DateUpdated = Carbon\Carbon::now();
            $userVote->Upvote = 1;
            $userVote->save();
        }
        elseif( UserVote::where('ForUserID', '=', $usrID->UserID)->where('FromUserID', '=', Session::get('UserID'))->exists() )
        {
            $userVote = UserVote::where('ForUserID', '=', $usrID->UserID)->where('FromUserID', '=', Session::get('UserID'))->first();
            $userVote->DateUpdated = Carbon\Carbon::now();
            $userVote->Upvote = 1;
            $userVote->save();
        }
        else
        {
            $usrID = User::where('UserProfileID', '=', Input::get('id'))->firstOrFail();
            $vote = new UserVote();
            $vote->ForUserID = $usrID->UserID;
            $vote->FromUserID = Session::get('UserID');
            $vote->DateCreated = Carbon\Carbon::now();
            $vote->Upvote = 1;
            $vote->save();
        }

        return 'succes';
    }

    public function setDownVote()
    {
        $usrID = User::where('UserProfileID', '=', Input::get('id'))->firstOrFail();
        if( UserVote::where('ForUserID', '=', Session::get('UserID'))->where('FromUserID', '=', $usrID->UserID)->exists() )
        {
            $userVote = UserVote::where('ForUserID', '=', Session::get('UserID'))->where('FromUserID', '=', $usrID->UserID)->first();
            $userVote->DateUpdated = Carbon\Carbon::now();
            $userVote->Upvote = 0;
            $userVote->save();
        }
        elseif( UserVote::where('ForUserID', '=', $usrID->UserID)->where('FromUserID', '=', Session::get('UserID'))->exists() )
        {
            $userVote = UserVote::where('ForUserID', '=', $usrID->UserID)->where('FromUserID', '=', Session::get('UserID'))->first();
            $userVote->DateUpdated = Carbon\Carbon::now();
            $userVote->Upvote = 0;
            $userVote->save();
        }
        else
        {
            $vote = new UserVote();
            $vote->ForUserID = $usrID->UserID;
            $vote->FromUserID = Session::get('UserID');
            $vote->DateCreated = Carbon\Carbon::now();
            $vote->Upvote = 0;
            $vote->save();
        }

        return 'succes';
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

    public function saveChanges($profileUrl)
    {
        $userProfile = UserProfile::where('ProfileUrlPart', '=', $profileUrl)->firstOrFail();
        $name = Input::get('name');
        $value = Input::get('value');

        if($name == 'Birthday')
        {
            $userProfile->$name = date("Y-m-d", strtotime($value));
            $userProfile->save();
        }
        else
        {
            $userProfile->$name = $value;
            $userProfile->save();
        }        
    }

    public function checkForConnectionByMail($connectID, $usrID, $acceptState)
    {
        if (Connection::where('ForUserID', '=', $usrID)->where('ConnectionID', '=', $connectID)->where('ConnectionStatusID', '=', '1')->exists()) {
            if ($acceptState == true) {
                $connection = Connection::where('ForUserID', '=', $usrID)->where('ConnectionID', '=', $connectID)->first();
                $connection->ConnectionStatusID = 2;
                $connection->save();
            }
            else {
                $connection = Connection::where('ForUserID', '=', $usrID)->where('ConnectionID', '=', $connectID)->first();
                $connection->ConnectionStatusID = 3;
                $connection->save();
            }
            return Redirect::to('/');
        }
        else {
            return Redirect::to('/');
        }
    }

    public function checkForConnection($profileID)
    {
        $forUser = User::where('UserProfileID', '=', $profileID)->firstOrFail();
        if (Connection::where('ForUserID', '=', $forUser->UserID)->where('FromUserID', '=', Session::get('UserID'))->exists()) {
            return true;
        }
        else {
            return false;
        }
    }

    public function setConnection()
    {
        $forUser = User::where('UserProfileID', '=', Input::get('user'))->firstOrFail();
        $forUserProfile = UserProfile::where('UserProfileID', '=', Input::get('user'))->firstOrFail();

        // Displayname user ophalen en in de mail zetten bij 'DisplayName'!!!

        $connection = new Connection();
        $connection->ForUserID = $forUser->UserID;
        $connection->FromUserID = Session::get('UserID');
        $connection->ConnectionStatusID = 1;
        $connection->DateCreated = Carbon\Carbon::now();
        $connection->DateUpdated = Carbon\Carbon::now();
        $connection->Message = '';
        $connection->save();

        $id = $connection->ConnectionID;

        // Mail::send('emails.connection', array('id'=> $id, 'DisplayName' => $forUserProfile->DisplayName), function($message) {
        //     $message->to(Session::get('Email'), $fromUserProfile->DisplayName)->subject('Nieuwe connectie!');
        // });

         Mail::send('emails.connection', array('id'=> $id, 'DisplayName' => $forUserProfile->DisplayName, 'usrID' => $forUser->UserID), function($message) {
             $message->to('wybrenjongstra@gmail.com', 'John Doe')->subject('Nieuwe connectie!');
         });

        return Redirect::to('/profile/'.Input::get('url'));
    }

    public function getReviews($profileID)
    {
        $reviews = Review::where('ForUserProfileID', '=', $profileID)->get();

        $reviewArray = array();
        foreach ($reviews as $review) {
            $reviewArray[] = $review->Text;
        }
        return $reviewArray;
    }

    public function getHashTags($profileID)
    {
        $places = Hashtag::where('UserProfileID', '=', $profileID)->get();

        $placeArray = array();
        foreach ($places as $place) {
            $placeArray[] = $place->Value;
        }
        return $placeArray;
    }

    public function getSkills($profileID)
    {
        $skills = Skill::where('UserProfileID', '=', $profileID)->get();

        $skillArray = array();
        foreach ($skills as $skill) {
            $skillArray[] = $skill->Value;
        }
        return $skillArray;
    }

    public function getInterests($profileID)
    {
        $interests = Interest::where('UserProfileID', '=', $profileID)->get();

        $interestArray = array();
        foreach ($interests as $interest) {
            $interestArray[] = $interest->Value;
        }
        return $interestArray;
    }
}
