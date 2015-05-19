<?php

class Register extends Eloquent {
        protected $guarded = array();
        protected $table = 'registered_users'; // table name
        public $timestamps = 'false' ; // to disable default timestamp fields
 
        // model function to store form data to database
        public static function saveFormData($user)
        {
            DB::table('USER')->insert($user);
        }
 
}

?>