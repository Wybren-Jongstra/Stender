<?php

class Review extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'REVIEW';

    /**
     * The primairy key of the database table
     * @var string
     */
    protected $primaryKey = 'ReviewID';

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
    protected $guarded = array('ReviewID');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');


}
