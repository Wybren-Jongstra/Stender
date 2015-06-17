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
                
                //$link = $userProfile->list;
                
                //$contents = $this->getContent($link);

                //$res = file_get_contents($link);
                //echo $res;
                $likes = array();
                foreach($userInterests->likes as $interests)
                {
                    
                    $likes[] = $interests['name'];
                    
                }

                $this->saveToDB($likes, 3);

            }
            else
            {
                // TODO test this; throw invalid argument exception instead of echo!
                // don't go further because there is no active network
                echo 'no network selected!';
            }

            $provider->logout();

            //$urlpart = UserProfile::find(Auth::user()->UserProfileID);
            return View::make('closePopup');
        }
        catch(Exception $e) 
        {
            // exception codes can be found on HybBridAuth's web site
            return 'Op dit moment kunnen wij de gegevens niet voor je ophalen, probeer het later nog eens. </ br>'.
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

    public function deleteInterest()
    {
        $interestID = Input::get('id');
        $id = explode("interest", $interestID);
        $interest = Skill::find($id[1]);
        $interest->delete();
    }
}
