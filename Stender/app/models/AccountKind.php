<?php

class AccountKind extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ACCOUNT_KIND';

    /**
     * The primary key of the database table
     * @var string
     */
    protected $primaryKey = 'AccountKindID';

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
    protected $guarded = array('AccountKindID');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('AccountKindID');


}
