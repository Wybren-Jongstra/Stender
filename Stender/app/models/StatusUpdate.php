<?php

class StatusUpdate extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'STATUS_UPDATE';

    /**
     * The primairy key of the database table
     * @var string
     */
    protected $primaryKey = 'StatusUpdateID';

    /**
     * Disable the insertion of timestamps that are automatically created by Laravel.
     * @var bool
     */
    public $timestamps = false;

    public function User()
    {
        return $this->belongsTo('User');
    }

    /**
     * Prevents the listed columns from mass assignment.
     *
     * @var array
     */
    protected $guarded = array('StatusUpdateID');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');


}
