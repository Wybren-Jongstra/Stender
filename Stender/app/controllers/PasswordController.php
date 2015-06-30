<?php

class PasswordController extends BaseController {

    /**
     * Check input values are valid and change the password.
     * @return mixed
     */
    public function change()
    {
        //get input
        $input = Input::all();
        //rules to validate input
        $rules = array(
            'oldPassword'               => 'required',
            'password' 	                => 'required',
            'password_confirmation'	 	=> 'required',
        );

        //check validation
        $v = Validator::make($input, $rules);
        $v->setAttributeNames( array(
                'oldPassword'               => Lang::get('attributes.old_password'),
                'password' 	                => Lang::get('attributes.new_password'),
                'password_confirmation'	 	=> Lang::get('attributes.confirm_password'),
            )
        );

        //store data in user object and save to database
        if($v->passes())
        {
            if (Hash::check($input['oldPassword'], Auth::user()->Password))
            {
                if($input['password'] == $input['password_confirmation'])
                {
                    Auth::user()->Password = Hash::make($input['password']);
                    Auth::user()->save();
                    Mail::send('emails.passwordChanged', array(), function($message) {
                        $message->to('stenderapp@gmail.com', 'John Doe')->subject('Wachtwoord gewijzigd');
                    });
                    return Redirect::to('/settings')->withSuccess( Lang::get('reminders.changed') );
                }
                else
                {
                    return Redirect::to('/settings')->withErrors('De wachtwoorden komen niet overeen.');
                }
            }
            else
            {
                return Redirect::to('/settings')->withErrors('Het oude wachtwoord is onjuist.');
            }
        }
        else
        {
            return Redirect::to('/settings')->withErrors(Lang::get('validation.custom.message'));
        }
    }
}