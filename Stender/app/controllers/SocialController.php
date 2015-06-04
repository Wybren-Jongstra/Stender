<?php

class SocialController extends BaseController {

    public function rommelData()
    {
        $userprofile = UserProfile::find(Auth::user()->UserProfileID);

        $data = array(
            'firstname'  => $userprofile->FirstName,
            'ProfileUrlPart' => $userprofile->ProfileUrlPart,
            );

        return $data;
    }

    public function login($action='')
    {
        $network = Input::get('network');

        if ( $action == "auth" ) 
        {
            try 
            {
                Hybrid_Endpoint::process();
            }
            catch ( Exception $e ) 
            {
                echo "Error at Hybrid_Endpoint process (SocialController@login): $e";
            }
            return;
        }
        try
        {
            if ( $network == "twitter" ) 
            {
                // create a HybridAuth object
                $socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
                // authenticate with Google
                $provider = $socialAuth->authenticate("twitter");
                // fetch user profile
                $userProfile = $provider->getUserProfile();
                $user_timeline = $provider->getUserActivity("timeline");

                //acces user profile and save hashtags in array
                $hashtags = array();

                foreach ($user_timeline as $timeline) 
                {
                    $hashtags[] = $timeline->hashtags;
                }
                $this->saveToDB($hashtags, '2');


                $this->Logout();
            }
            else
            {
                echo "no network selected!";
            }

            $provider->logout();

        }
        catch(Exception $e) 
        {
                    // exception codes can be found on HybBridAuth's web site
            return $e->getMessage();
        }
    }

    public function saveToDB($value, $hashtagKind)
    {
        foreach ($value as $hashtags)
        {
            foreach ($hashtags as $tag)
            {

                $hashtag = new Hashtag();
                $hashtag->AccountKindID = $hashtagKind;
                $hashtag->Value = $tag->text;
                $hashtag->UserProfileID = Auth::user()->UserProfileID;
                $hashtag->save();

                $this->updateHashtags();
            }
        }

    }

    public function updateHashtags()
    { 
        $hashtagsUser = Hashtag::where('UserProfileID', '=', Auth::user()->UserProfileID)->get();

        $hashtags = array();

        foreach($hashtagsUser as $hashtag)
        {

        $hashtags[] = $hashtag;
        
        }
        
        return View::make('social')->with('twitter', $hashtags)->with('data', $this->rommelData());
    }

    public function Logout()
    {
                // logout

    }

    public function deleteHashtag()
    {
        $id = Input::get('id');
        $tag = Hashtag::find($id);
        $tag->delete();
    }
}
