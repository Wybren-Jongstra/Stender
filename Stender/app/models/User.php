<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'USER';

    /**
     * The primairy key of the database table
     * @var string
     */
    protected $primaryKey = 'UserID';

    /**
     * Disable the insertion of timestamps that are automatically created by Laravel.
     * @var bool
     */
	public $timestamps = false;

    /**
    * Prevents the listed columns from mass assignment.
    *
    * @var array
    */
    protected $guarded = array('id');
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    // public function getAuthIdentifier()
    // {
    //     return $this->Email;
    // }

    /**
     * Override to get the password for the user from the correct column from the database.
     *
     * {@inheritDoc}
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->Password;
    }

    /**
     * Override to get the correct column name for the "remember me" token.
     *
     * {@inheritDoc}
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        // TODO Test disabeling of this code
        return 'RememberToken';
    }
}
