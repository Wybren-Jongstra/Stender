<?php

class SettingsController extends BaseController {

    public function getSettings()
    {
        $profileData = $this->getData();
        return View::make('settings')->with('data', $profileData)->with('externalAccountKinds', $this->getExternalAccountKindData());
    }

    public function getData()
    {
        $userprofile = UserProfile::find(Auth::user()->UserProfileID);

        $data = array(
//            'UserProfileID'  => $userprofile->UserProfileID,
//            'DateUpdated' => $userprofile->DateUpdated,
            'ProfileUrlPart'  => $userprofile->ProfileUrlPart,
            'DisplayName'  => $userprofile->DisplayName,
//            'PhotoUrl' => $userprofile->PhotoUrl,
            'FirstName'  => $userprofile->FirstName,
            'Surname'  => $userprofile->Surname,
//            'Prefix' => $userprofile->Prefix,
//            'MiddleName'  => $userprofile->MiddleName,
            'SurnamePrefix'  => $userprofile->SurnamePrefix,
//            'Suffix' => $userprofile->Suffix,
//            'Birthday'  => date("d-m-Y", strtotime($userprofile->Birthday)),
//            'GenderID'  => $userprofile->GenderID,
//            'SexualOrientation' => $userprofile->SexualOrientation,
//            'StreetName'  => $userprofile->StreetName,
//            'HouseNumber'  => $userprofile->HouseNumber,
//            'HouseNumberSuffix' => $userprofile->HouseNumberSuffix,
//            'Zip'  => $userprofile->Zip,
//            'City'  => $userprofile->City,
//            'Country' => $userprofile->Country,
//            'AlternativeEmail'  => $userprofile->AlternativeEmail,
//            'Education'  => $userprofile->Education,
            'Email' => Auth::user()->Email,
        );

        return $data;
    }

    public function getExternalAccountKindData()
    {
//        /* This code uses a join, therefore one query less must be executed.
//         * That gives that this code is twice as fast but is uses not the models. */
//        $tempExternalAccountKind = new ExternalAccountKind();
//        $tempAccountKind = new AccountKind();
//
//        $dbQuery = DB::table($tempExternalAccountKind->getTable())
//            ->leftJoin($tempAccountKind->getTable(), $tempAccountKind->getQualifiedKeyName(), '=', $tempExternalAccountKind->getQualifiedKeyName())
//            ->select('Name', 'PopupHeight', 'PopupWidth')
//            ->get();

        return ExternalAccountKind::with('accountKind')->get()->toArray();
    }

//    public function saveChanges($profileUrl)
//    {
//        $userProfile = UserProfile::where('ProfileUrlPart', '=', $profileUrl)->firstOrFail();
//        $name = Input::get('name');
//        $value = Input::get('value');
//
//        if($name == 'Birthday')
//        {
//            $userProfile->$name = date("Y-m-d", strtotime($value));
//            $userProfile->save();
//        }
//        else
//        {
//            $userProfile->$name = $value;
//            $userProfile->save();
//        }
//    }
}
