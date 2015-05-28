<?php

class USERKINDTableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
            array('Name' => 'admin'),
            array('Name' => 'user'),
        );

        // TODO Replace this code with a model
        DB::table('USER_KIND')->insert($dbEntries);
	}

}