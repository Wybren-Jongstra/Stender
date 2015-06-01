<?php

class USERKINDTableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
            array('Name' => 'Admin'),
            array('Name' => 'User'),
        );

        // TODO Replace this code with a model
        DB::table('USER_KIND')->insert($dbEntries);
	}

}