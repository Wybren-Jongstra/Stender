<?php

class USERKINDTableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
            array('Name' => 'admin'),
            array('Name' => 'user'),
        );

        DB::table('USER_KIND')->insert($dbEntries);
	}

}