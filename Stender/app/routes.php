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

        $term = Input::get('term');

        $data = [
            'R' => 'Red',
            'O' => 'Orange',
            'Y' => 'Yellow',
            'G' => 'Green'

        ];

        $result = [];

        foreach($data as $color) {
            if(strpos(Str::lower($color),$term) !== false) {
                $result[] = ['value' => $color];
            }
        }

        return Response::json($result);

    });