<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//homepagina
Route::get('/', 'HomeController@getIndex');


//posten van registreren
Route::post('postRegister', 'HomeController@postRegister');

//timelinepagina
Route::get('timeline', 'TimelineController@getTimeline')->before('auth');
//Route::get('timeline', 'TimelineController@getTimeline');

//profielpagina
Route::get('profile/{profileUrl}', 'ProfileController@getProfile')->before('auth');

//Search controller
Route::get('search/autocomplete/', 'SearchController@autocomplete');
Route::get('searchUser', 'SearchController@searchUser');

//posten van login
//Route::post('login', array('uses' => 'HomeController@postLogin'));

Route::resource('sessions', 'SessionsController');
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');

Route::get('verify/{confirmationCode}', 'SessionsController@verify');

Route::get('test', function()
{
    $userprofile = UserProfile::find(Auth::user()->UserProfileID);
    echo $userprofile->FirstName;
});

Route::get('search', function(){

       return View::make('search');

    });
Route::get('getdata',function(){

        echo microtime(true);

    });

Route::get('social/{action?}', array("as" => "hybridauth", function($action = "")
{
    // check URL segment
    if ($action == "auth") {
        // process authentication
        try {
            Hybrid_Endpoint::process();
        }
        catch (Exception $e) {
            // redirect back to http://URL/social/
            return Redirect::route('hybridauth');
        }
        return;
    }
    try {
        // create a HybridAuth object
        $socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
        // authenticate with Google
        $provider = $socialAuth->authenticate("facebook");
        // fetch user profile
        $userProfile = $provider->getUserProfile();
    }
    catch(Exception $e) {
        // exception codes can be found on HybBridAuth's web site
        return $e->getMessage();
    }
    // access user profile data
    //echo "Connected with: <b>{$provider->id}</b><br />";
    //echo "As: <b>{$userProfile->displayName}</b><br />";
    //echo "<pre>" . print_r( $userProfile, true ) . "</pre><br />";



    // logout
    $provider->logout();

    //compleet iets anders maargoed:
    $userprofile = UserProfile::find(Auth::user()->UserProfileID);

        $data = array(
        'firstname'  => $userprofile->FirstName,
        'ProfileUrlPart' => $userprofile->ProfileUrlPart,
        );

    return View::make('facebook')->with('data', $data)->with('fb', $userProfile);
}));