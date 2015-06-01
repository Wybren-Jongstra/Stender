<?php

class ProfileController extends BaseController {

    private $data = array();

    public function getProfile($profileUrl)
    {
        $userprofile = UserProfile::where('ProfileUrlPart', '=', $profileUrl)->firstOrFail();

        $data['UserProfileID'] = $userprofile->UserProfileID;
        $data['DateUpdated'] = $userprofile->DateUpdated;
        $data['ProfileUrlPart'] = $userprofile->DateUpdated;
        $data['DisplayName'] = $userprofile->DateUpdated;
        $data['PhotoUrl'] = $userprofile->DateUpdated;
        $data['FirstName'] = $userprofile->DateUpdated;
        $data['Surname'] = $userprofile->DateUpdated;
        $data['Prefix'] = $userprofile->DateUpdated;
        $data['MiddleName'] = $userprofile->DateUpdated;
        $data['SurnamePrefix'] = $userprofile->DateUpdated;
        $data['FirstName'] = $userprofile->DateUpdated;
        $data['Surname'] = $userprofile->DateUpdated;
        $data['Prefix'] = $userprofile->DateUpdated;
        $data['MiddleName'] = $userprofile->DateUpdated;
        $data['PhotoUrl'] = $userprofile->DateUpdated;
        $data['FirstName'] = $userprofile->DateUpdated;
        $data['Surname'] = $userprofile->DateUpdated;
        $data['Prefix'] = $userprofile->DateUpdated;
        $data['MiddleName'] = $userprofile->DateUpdated;
            'ProfileUrlPart' => $userprofile->ProfileUrlPart,
            'DisplayName' => $userprofile->DisplayName,
            '' => $userprofile->PhotoUrl,
            '' => $userprofile->FirstName,
            '' => $userprofile->Surname,
            '' => $userprofile->Prefix,
            '' => $userprofile->MiddleName,
            '' => $userprofile->SurnamePrefix,
            'Suffix' => $userprofile->Suffix,
            'Birthday' => $userprofile->Birthday,
            'GenderID' => $userprofile->GenderID,
            'SexualOrientation' => $userprofile->SexualOrientation,
            'StreetName' => $userprofile->StreetName,
            'HouseNumber' => $userprofile->HouseNumber,
            'HouseNumberSuffix' => $userprofile->HouseNumberSuffix,
            'Zip' => $userprofile->Zip,
            'City' => $userprofile->City,
            'Country' => $userprofile->Country,
            'AlternativeEmail' => $userprofile->AlternativeEmail,
            'Education' => $userprofile->Education,
        );

        $interests = $this->getInterests($data['UserProfileID']);
        $skills = $this->getSkills($data['UserProfileID']);
        $places = $this->getHashTags($data['UserProfileID']);
        $reviews = $this->getReviews($data['UserProfileID']);

        return View::make('profile')->with('data', $data)->with('interests', $interests)->with('skills', $skills)->with('places', $places)->with('reviews', $reviews);
    }

    public function setConnection()
    {
        $forUser = User::where('UserProfileID', '=', Input::get('user'))->firstOrFail();

        $connection = new Connection();
        $connection->ForUserID = $forUser->UserID;
        $connection->FromUserID = Session::get('UserID');
        $connection->ConnectionStatusID = 1;
        $connection->DateCreated = Carbon\Carbon::now();
        $connection->DateUpdated = Carbon\Carbon::now();
        $connection->Message = '';
        $connection->save();

        $id = $connection->ConnectionID;



        // Mail::send('emails.Welcome', array('id'=> $id), function($message) {
        //   		$message->to($input['email'], $input['firstname'])->subject('Please activate your account!');
        // });

         Mail::send('emails.Welcome', array('id'=> $id, 'DisplayName' => $data['DisplayName']), function($message) {
             $message->to('wybrenjongstra@gmail.com', 'John Doe')->subject('Please activate your account!');
         });

        return Redirect::to('/profile/'.Input::get('url'));
    }

    public function getReviews($profileID)
    {
        $reviews = Review::where('ForUserID', '=', $profileID)->get();

        $reviewArray = array();
        foreach ($reviews as $review) {
            $reviewArray[] = $review->Text;
        }
        return $reviewArray;
    }

    public function getHashTags($profileID)
    {
        $places = Place::where('UserProfileID', '=', $profileID)->get();

        $placeArray = array();
        foreach ($places as $place) {
            $placeOptions = PlaceOption::where('PlaceOptionID', '=', $place->PlaceOptionID)->get();
            foreach ($placeOptions as $placeOption) {
                $placeArray[] = $placeOption->Name;
            }
        }
        return $placeArray;
    }

    public function getSkills($profileID)
    {
        $skills = Skill::where('UserProfileID', '=', $profileID)->get();

        $skillArray = array();
        foreach ($skills as $skill) {
            $skillOptions = SkillOption::where('SkillOptionID', '=', $skill->SkillOptionID)->get();
            foreach ($skillOptions as $skillOption) {
                $skillArray[] = $skillOption->Name;
            }
        }
        return $skillArray;
    }

    public function getInterests($profileID)
    {
        $interests = Interest::where('UserProfileID', '=', $profileID)->get();

        $interestArray = array();
        foreach ($interests as $interest) {
            $interestOptions = InterestOption::where('InterestOptionID', '=', $interest->InterestOptionID)->get();
            foreach ($interestOptions as $interestOption) {
                $interestArray[] = $interestOption->Name;
            }
        }
        return $interestArray;
    }
}
