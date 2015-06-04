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
Route::post('connect', 'ProfileController@setConnection');
Route::get('connection/{id}/{usrID}/{state}', 'ProfileController@checkForConnectionByMail');
Route::get('upvote', 'ProfileController@setUpVote');
Route::get('downvote', 'ProfileController@setDownVote');

//profielpagina aanpassen
Route::get('editProfile/{profileUrl}', 'ProfileController@editProfile')->before('auth');
//save de aanpassingen:
Route::post('saveProfile/{profileUrl}', 'ProfileController@saveChanges')->before('auth');

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
    echo Hash::make('test');
});

Route::get('search', function(){

       return View::make('search');

    });
Route::get('getdata',function(){

        echo microtime(true);

    });

Route::get('social/{action?}','SocialController@Login');
Route::get('hashtags', 'SocialController@updateHashtags');
Route::post('deleteHashtag', 'SocialController@deleteHashtag');