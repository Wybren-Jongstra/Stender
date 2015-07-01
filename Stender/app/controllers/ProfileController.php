<?php

class ProfileController extends BaseController {

    public function getProfile($profileUrl)
    {
        
            $profileData = $this->getData($profileUrl);
            $connectionSum = $this->getNumberConnections($profileData['UserProfileID']);
            $stenderScore = $this->getStenderScore($profileData['UserProfileID']);
            $vote = $this->checkForVoteFromUser($profileData['UserProfileID']);
        	$getCheckConnection = $this->checkForConnection($profileData['UserProfileID']);
            $interests = $this->getInterests($profileData['UserProfileID']);
            $skills = $this->getSkills($profileData['UserProfileID']);
            $hashtags = $this->getHashTags($profileData['UserProfileID']);
            $reviews = $this->getReviews($profileData['UserProfileID']);
            $education = $this->getEducation($this->getData($profileUrl)['EducationID']);

            return View::make('profile')->with('data', $profileData)->with('interests', $interests)->with('skills', $skills)
                ->with('hashtags', $hashtags)->with('reviews', $reviews)->with('connectionState', $getCheckConnection)
                ->with('connections', $connectionSum)->with('stenderScore', $stenderScore)->with('vote', $vote)
                ->with('education', $education);
    }

    /**
     * Open the edit profile view.
     * @param $profileUrl
     * @return mixed
     */
    public function editprofile($profileUrl)
    {
        if($profileUrl == Session::get('ProfileUrlPart'))
        {
            $profileData = $this->getData($profileUrl);
            $connectionSum = $this->getNumberConnections($profileData['UserProfileID']);
            $stenderScore = $this->getStenderScore($profileData['UserProfileID']);
            $vote = $this->checkForVoteFromUser($profileData['UserProfileID']);
            $getCheckConnection = $this->checkForConnection($profileData['UserProfileID']);
            $reviews = $this->getReviews($profileData['UserProfileID']);
            $education = $this->getEducations();
            $skills = $this->getSkills($profileData['UserProfileID']);
            $hashtags = $this->getHashTags($profileData['UserProfileID']);
            $interests = $this->getInterests($profileData['UserProfileID']);
            return View::make('editProfile')->with('data', $this->getData($profileUrl))->with('skills', $skills)
                ->with('hashtags', $hashtags)->with('education', $education)->with('reviews', $reviews)
                ->with('connectionState', $getCheckConnection)->with('connections', $connectionSum)
                ->with('stenderScore', $stenderScore)->with('vote', $vote)->with('interests', $interests)
                ->with('externalAccountKinds', $this->getExternalAccountKindData());
        }
        else
        { 
            return Redirect::to('profile/'.$profileUrl);
        }
        
    }

    /**
     * Get all the data of an user by the ProfileUrlPart
     * @param $profileUrl
     * @return array
     */
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
        'EducationID'  => $userprofile->EducationID,
        );

        return $data;
    }

    /**
     * Check of the authenticated user already voted on a user.
     * @param $profileID
     * @return bool|int|string
     */
    public function checkForVoteFromUser($profileID)
    {
        $forUser = User::where('UserProfileID', '=', $profileID)->firstOrFail();

        if (UserVote::where('ForUserID', '=', $forUser->UserID)->where('FromUserID', '=', Session::get('UserID'))->exists()) {
            $vote = UserVote::where('ForUserID', '=', $forUser->UserID)->where('FromUserID', '=', Session::get('UserID'))->first();
            if($vote->Upvote >= 1)
            {
                return 1;
            }
            else
            {
                return false;
            }
        }
        else {
            return 'no vote';
        }
    }

    /**
     * Upvote an user.
     * @return string
     */
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

    /**
     * Down vote an user.
     * @return string
     */
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

    /**
     * Get the total number connections by UserProfileID.
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

    /**
     * Change the profile image.
     * @return mixed
     */
    public function changeProfileImage()
    {
        $userProfile = UserProfile::where('UserProfileID', '=', Session::get('UserProfileID'))->firstOrFail();
        $destinationPath = '';
        $filename        = '';

        if (Input::hasFile('newProfileImage'))
        {
            // Build the input for our validation
            $input = array('image' => Input::file('newProfileImage'));

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
                return Redirect::to('/editProfile/'.Session::get('ProfileUrlPart'))->withErrors('Upload een afbeelding.');
            }
            else
            {
                $file            = Input::file('newProfileImage');
                $destinationPath = 'uploads/';
                $filename        = Session::get('UserID') . '_' . str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $userProfile->PhotoUrl = $destinationPath . $filename;
            }
        }

        $userProfile->save();

        return Redirect::to('/editProfile/'.Session::get('ProfileUrlPart'));
    }

    /**
     * Change the ConnectionStatusID by the URL which a user get, by mail, if someone tried to connect with him.
     * @param $connectID
     * @param $usrID
     * @param $acceptState
     * @return mixed
     */
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

    /**
     * Check of there is a connection between two users.
     * @param $profileID
     * @return bool
     */
    public function checkForConnection($profileID)
    {
        $forUser = User::where('UserProfileID', '=', $profileID)->firstOrFail();
        if (Connection::where('ForUserID', '=', $forUser->UserID)->where('FromUserID', '=', Session::get('UserID'))->exists() ||
            Connection::where('FromUserID', '=', $forUser->UserID)->where('ForUserID', '=', Session::get('UserID'))->exists()) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Set a connection between two users.
     * Set the ConnectionStatusID to 1 -> 'Waiting'.
     * Mail the requested user for approval of this connection.
     * @return mixed
     */
    public function setConnection()
    {
        $forUser = User::where('UserProfileID', '=', Input::get('user'))->firstOrFail();
        $forUserProfile = UserProfile::where('UserProfileID', '=', Input::get('user'))->firstOrFail();

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
            $message->to('stenderapp@gmail.com', 'John Doe')->subject('Nieuwe connectie!');
        });

        return Redirect::to('/profile/'.Input::get('url'));
    }

    /**
     * Post a review and save it in the database
     * @return mixed
     */
    public function postReview()
    {
        $review = new Review();
        $review->ForUserProfileID = Input::get('usr');
        $review->FromUserProfileID = Session::get('UserProfileID');
        $review->DateCreated = Carbon\Carbon::now();
        $review->Deleted = 0;
        $review->Text = htmlentities(Input::get('userReview'));
        $review->save();

        $forUserProfile = UserProfile::where('UserProfileID', '=', Input::get('usr'))->firstOrFail();

        // For the live version
        //Mail::send('emails.review', array('fromName' => Session::get('DisplayName'),'profUrl' => $forUserProfile->ProfileUrlPart), function($message) {
        //    $forUser = User::where('UserProfileID', '=', Input::get('usr'))->firstOrFail();
        //    $forUserProfile = UserProfile::where('UserProfileID', '=', Input::get('usr'))->firstOrFail();
        //    $message->to($forUser->Email, $forUserProfile->DisplayName)->subject('Nieuwe review!');
        //});

        Mail::send('emails.review', array('fromName' => Session::get('DisplayName'),'profUrl' => $forUserProfile->ProfileUrlPart), function($message) {
            $message->to('stenderapp@gmail.com', 'John Doe')->subject('Nieuwe review!');
        });

        return Redirect::to('/profile/'.$forUserProfile->ProfileUrlPart);
    }

    /**
     * Get the reviews by UserProfileID
     * @param $profileID
     * @return array
     */
    public function getReviews($profileID)
    {
        $reviews = Review::where('ForUserProfileID', '=', $profileID)->get();

        $reviewArray = array();
        $item = 0;
        foreach ($reviews as $review) {
            $userProfile = UserProfile::where('UserProfileID', '=', $review->FromUserProfileID)->firstOrFail();
            $reviewArray[$item][] = $userProfile->ProfileUrlPart;
            $reviewArray[$item][] = $userProfile->DisplayName;
            $reviewArray[$item][] = date("d-m-Y", strtotime($review->DateCreated));
            $reviewArray[$item][] = $review->Text;
            $reviewArray[$item][] = $review->ReviewID;
            $reviewArray[$item][] = $review->FromUserProfileID;
            $item++;
        }
        return $reviewArray;
    }

    /**
     * Delete an excisting review by ReviewID
     * @param $reviewID
     * @return mixed
     */
    public function deleteReview($reviewID)
    {
        $review = Review::where('ReviewID', '=', $reviewID)->firstOrFail();
        $review->delete();
        return Redirect::to('/profile/'.Session::get('ProfileUrlPart'));
    }

    /**
     * Get the hashtags of an user by UserProfileID
     * @param $profileID
     * @return array
     */
    public function getHashTags($profileID)
    {
        $hashtags = Hashtag::where('UserProfileID', '=', $profileID)->get();

        $hashtagArray = array();
        foreach ($hashtags as $hashtag) {
            $hashtagArray[$hashtag->HashtagID] = $hashtag->Value;
        }

        return $hashtagArray;
    }

    /**
     * Get the skills of an user by UserProfileID
     * @param $profileID
     * @return array
     */
    public function getSkills($profileID)
    {
        $skills = Skill::where('UserProfileID', '=', $profileID)->get();

        $skillArray = array();
        foreach ($skills as $skill) {
            $skillArray[$skill->SkillID] = $skill->Value;

        }

        return $skillArray;
    }

    /**
     * Get the interests of an user by UserProfileID
     * @param $profileID
     * @return array
     */
    public function getInterests($profileID)
    {
        $interests = Interest::where('UserProfileID', '=', $profileID)->get();

        $interestArray = array();
        foreach ($interests as $interest) {
            $interestArray[$interest->InterestID] = $interest->Value;
        }        

        return $interestArray;
    }

    /**
     * Get all the educations from the database
     * @return mixed
     */
    public function getEducations()
    {
        $Education = Education::all();

        return $Education;
    }

    /**
     * Get the education by an EducationID
     * @param $id
     * @return mixed
     */
    public function getEducation($id)
    {
        $Education = Education::where('EducationID', '=', $id)->first();

        return $Education;
    }

    /**
     * Get all external account kind data as an associative array.
     *
     * @return array An array with all external accounts.
     */
    public function getExternalAccountKindData()
    {
        $externalAccountKinds = ExternalAccountKind::with('accountKind')->get();

        $externalAccountKindsArray = array();
        foreach($externalAccountKinds as $externalAccountKind)
        {
            $externalAccountKindsArray[$externalAccountKind->accountKind->Name] = $externalAccountKind->toArray();
        }

        return $externalAccountKindsArray;
    }

    /**
     * Change the education of an User.
     */
    public function changeEducation()
    {
        $id = Input::get('id');
        $user = UserProfile::where('UserProfileID', '=', Session::get('UserProfileID'))->firstOrFail();
        $user->educationID = $id;
        $user->save();
    }
}
