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
                $this->saveToDB($hashtags, 2);


                $this->Logout();
            }
            elseif ( $network == "linkedin" ) 
            {
                // create a HybridAuth object
                $socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
                // authenticate with Google
                $provider = $socialAuth->authenticate("LinkedIn");
                // fetch user profile
                $userProfile = $provider->getUserProfile();
                //$user_timeline = $provider->getUserActivity("timeline");

                $link = $userProfile->profileURL;

                $contents = $this->getContent($link);

                $html = new \Htmldom($contents);

                $skills = array();
                // Find all skills
                foreach($html->find('a.endorse-item-name-text') as $element)
                { 
                    $skills[] = $element->plaintext;
                }

                $this->saveToDB($skills, 4);

                $this->Logout();
            }
            elseif ( $network == "foursquare" ) 
            {
                // create a HybridAuth object
                $socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
                // authenticate with Google
                $provider = $socialAuth->authenticate("Foursquare");
                // fetch user profile
                $userProfile = $provider->getUserProfile();
                
                $link = $userProfile->list;
                
                 $contents = $this->getContent($link);

                $res = file_get_contents($link);
                echo $res;

                $this->Logout();
                die();
            }
            else
            {
                echo "no network selected!";
            }

            $provider->logout();
            $urlpart = UserProfile::find(Auth::user()->UserProfileID);
                return Redirect::to('closeWindow');

        }
        catch(Exception $e) 
        {

                    // exception codes can be found on HybBridAuth's web site
            return "Op dit moment kunnen wij de gegevens niet voor je ophalen, probeer het later nog eens. </ br>".
            $e->getMessage();
        }
                    
    }

    public function getContent($url)
    {
        $ch = curl_init();
        $timeout = 5; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }

    public function saveToDB($value, $accountKind)
    {
        if($accountKind == 2) //twitter
        {
            foreach ($value as $hashtags)
            {
                foreach ($hashtags as $tag)
                {

                    $hashtag = new Hashtag();
                    $hashtag->AccountKindID = $accountKind;
                    $hashtag->Value = $tag->text;
                    $hashtag->UserProfileID = Auth::user()->UserProfileID;
                    $hashtag->save();

                }
            }
        }
        if($accountKind == 4) //LinkedIN
        {
            foreach ($value as $skills) 
            {
                $skill = new Skill();
                $skill->AccountKindID = $accountKind;
                $skill->Value = $skills;
                $skill->UserProfileID = Auth::user()->UserProfileID;
                $skill->save();

            }
        }
    }

    public function update()
    { 
        $hashtagsUser = Hashtag::where('UserProfileID', '=', Auth::user()->UserProfileID)->get();
        $skillsUser = Skill::where('UserProfileID', '=', Auth::user()->UserProfileID)->get();


        
        $hashtags = array();
        $skills = array();

        foreach($hashtagsUser as $hashtag)
        {

        $hashtags[] = $hashtag;
        
        }
        foreach($skillsUser as $skill)
        {

        $skills[] = $skill;
        
        }
        
        return View::make('social')->with('twitter', $hashtags)->with('linkedin', $skills)->with('data', $this->rommelData());
    }

    public function Logout()
    {
                // logout

    }

    public function deleteHashtag()
    {
        $hashtagID = Input::get('id');
        $id = explode("hashtag", $hashtagID);

        $tag = Hashtag::find($id[1]);
        $tag->delete();
    }

    public function deleteSkill()
    {
        $skillID = Input::get('id');
        $id = explode("skill", $skillID);
        $skill = Skill::find($id[1]);
        $skill->delete();
    }
    public function closeWindow()
    {
        return View::make('close');
    }
}
