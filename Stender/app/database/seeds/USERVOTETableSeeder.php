<?php

class USERVOTETableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
            array('ForUserID' => '3', 'FromUserID' => '2', 'DateCreated' => '2015-06-18 08:33:50', 'Upvote' => '1'),
            array('ForUserID' => '1', 'FromUserID' => '2', 'DateCreated' => '2015-06-18 08:34:01', 'Upvote' => '0'),
        );

        // TODO Replace this code with a model
        DB::table('USER_VOTE')->insert($dbEntries);
	}

}