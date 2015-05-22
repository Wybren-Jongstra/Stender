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

//Route::get('/inlog', 'InlogController@showInlogPage');

//homepagina
Route::get('/', 'HomeController@getIndex');


//posten van registreren
Route::post('postRegister', 'HomeController@postRegister');

//timelinepagina
Route::get('timeline', 'TimelineController@getTimeline')->before('auth');
//Route::get('timeline', 'TimelineController@getTimeline');

//Search controller
Route::get('search/autocomplete/{q}', 'SearchController@autocomplete');
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


Route::get('/admin/searches', function(){
$in = array(
    "suggestions" => array(
        array("value" => "one", "data" => "ON"),
        array("value" => "two", "data" => "TW"),
        array("value" => "three", "data" => "TH"),
        array("value" => "four", "data" => "FO"),
    )
);
return Response::json($in);
});