<?php

class UserProfile extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'USER_PROFILE';

	 /**
     * The primairy key of the database table
     * @var string
     */
    protected $primaryKey = 'UserProfileID';

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
    protected $guarded = array('UserProfileID');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('');

    /**
     * Defines the relationship with the User model.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->hasOne('User', 'UserID');
    }

    
}
