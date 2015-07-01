<?php

class SocialController extends BaseController {

    /**
     * Get the userdata of the authenticated user
     * @return array
     */
    public function getUserData()
    {
        $userprofile = UserProfile::find(Auth::user()->UserProfileID);
        $data = array(
            'firstname'  => $userprofile->FirstName,
            'ProfileUrlPart' => $userprofile->ProfileUrlPart,
        );

        return $data;
    }

    /**
     * Login at a social media website by creating a hybridauth object.
     * Get the hashtags/ interests/ skills and save them in the database.
     * @param string $action
     * @return string
     */
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
            // create a HybridAuth object
            $socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');

            if ( $network == "twitter" ) 
            {
                // authenticate with provider
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
            }
            elseif ( $network == "linkedin" ) 
            {
                // authenticate with provider
                $provider = $socialAuth->authenticate("LinkedIn");
                // fetch user profile
                $userProfile = $provider->getUserProfile();
                //$user_timeline = $provider->getUserActivity("timeline");

                // get profile URL
                $link = $userProfile->profileURL;

                // grab content
                $contents = $this->getContent($link);

                // create DOM of content
                $html = new \Htmldom($contents);

                // Find all skills
                $skills = array();
                foreach($html->find('a.endorse-item-name-text') as $element)
                { 
                    $skills[] = $element->plaintext;
                }

                $this->saveToDB($skills, 4);
            }
            elseif ( $network == "facebook" )
            {
                // authenticate with Google
                $provider = $socialAuth->authenticate("Facebook");
                // fetch user profile
                $userInterests = $provider->getUserInterests();
                
                $likes = array();
                foreach($userInterests->likes as $interests)
                {
                    
                    $likes[] = $interests['name'];
                    
                }

                $this->saveToDB($likes, 3);

            }
            else
            {
                // don't go further because there is no active network
                throw new ErrorException( Lang::get('external_accounts.exception.unknown_network', ['network' => $network]) );
            }

            $provider->logout();
            return View::make('closePopup')->with(['externalAccount' => ucfirst($network)]);
        }
        catch(Exception $e)
        {
            // exception codes can be found on HybBridAuth's web site
            return 'Op dit moment kunnen wij de gegevens niet voor je ophalen, probeer het later nog eens. </ br>' .
                $e->getMessage();
        }
                    
    }

    /**
     * Get the content by an URL
     * @param $url
     * @return mixed
     */
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

    /**
     * Save data from twitter, facebook, linkedin in the database with the right AccountKindID
     * @param $value
     * @param $accountKind
     */
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
        if($accountKind == 3) //LinkedIN
        {
            foreach ($value as $interests) 
            {
                $interest = new Interest();
                $interest->AccountKindID = $accountKind;
                $interest->Value = $interests;
                $interest->UserProfileID = Auth::user()->UserProfileID;
                $interest->save();
            }
        }
    }

    /**
     * Update the existing data in the database.
     * @return mixed
     */
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
        return View::make('social')->with('twitter', $hashtags)->with('linkedin', $skills)->with('data', $this->getUserData());
    }

    /**
     * delete an hashtag
     */
    public function deleteHashtag()
    {
        $hashtagID = Input::get('id');
        $id = explode("hashtag", $hashtagID);
        $tag = Hashtag::find($id[1]);
        $tag->delete();
    }

    /**
     * delete a skill
     */
    public function deleteSkill()
    {
        $skillID = Input::get('id');
        $id = explode("skill", $skillID);
        $skill = Skill::find($id[1]);
        $skill->delete();
    }

    /**
     * delete an interest
     */
    public function deleteInterest()
    {
        $interestID = Input::get('id');
        $id = explode("interest", $interestID);
        $interest = Interest::find($id[1]);
        $interest->delete();
    }
}
