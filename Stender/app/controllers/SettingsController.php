<?php

class SettingsController extends BaseController {

    public function getSettings()
    {
        $profileData = $this->getData();
        return View::make('settings')->with('data', $profileData)->with('externalAccountKinds', $this->getExternalAccountKindData());
    }

    /**
     * Get the data of the authenticated user
     * @return array
     */
    public function getData()
    {
        $userprofile = UserProfile::find(Auth::user()->UserProfileID);

        $data = array(
            'ProfileUrlPart'  => $userprofile->ProfileUrlPart,
            'DisplayName'  => $userprofile->DisplayName,
            'FirstName'  => $userprofile->FirstName,
            'Surname'  => $userprofile->Surname,
            'SurnamePrefix'  => $userprofile->SurnamePrefix,
            'Email' => Auth::user()->Email,
        );

        return $data;
    }

    /**
     * Get all external account kind data as an normal array.
     *
     * @return array An array with all external accounts.
     */
    public function getExternalAccountKindData()
    {
        return ExternalAccountKind::with('accountKind')->get()->toArray();
    }
}
