<?php

class ProfileController extends BaseController {

    public function getProfile($profileUrl)
    {
        //$this->fillSession();
        
        return View::make('profile')->with('data', $this->getData($profileUrl));
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

    public static function fillSession()
    {
        Session::put('UserID', Auth::user()->UserID);
        Session::put('UserKindID', Auth::user()->UserKindID);
        Session::put('UserProfileID', Auth::user()->UserProfileID);
        Session::put('Email', Auth::user()->Email);

        
    }
}
