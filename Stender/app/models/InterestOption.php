<?php

class InterestOption extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'INTEREST_OPTION';

    /**
     * The primairy key of the database table
     * @var string
     */
    protected $primaryKey = 'InterestOptionID';

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
    protected $guarded = array('InterestOptionID');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');


}
