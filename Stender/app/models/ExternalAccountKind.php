<?php

class ExternalAccountKind extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'EXTERNAL_ACCOUNT_KIND';

    /**
     * The primary key of the database table
     * @var string
     */
    protected $primaryKey = 'ExternalAccountKindID';

    /**
     * Disable the insertion of timestamps that are automatically created by Laravel.
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates whether attributes are snake cased on arrays.
     *
     * @var bool
     */
    public static $snakeAttributes = false;

    /**
     * Prevents the listed columns from mass assignment.
     *
     * @var array
     */
    protected $guarded = array('ExternalAccountKindID');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('ExternalAccountKindID', 'AccountKindID');


    /**
     * Defines the relationship with the AccountKind model.
     *
     * Use the name of this method with the 'with' method to grab the associated AccountKind model of this model.
     * That method uses eager loading to alleviate the N + 1 query problem.
     * When you use the 'with' method with this model that corresponding name is directly used as the name of the attribute
     * on the model's array and JSON form.
     *
     * @return mixed
     */
    public function accountKind()
    {
        return $this->belongsTo('AccountKind', 'AccountKindID');
    }


}
