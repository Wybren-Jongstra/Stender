<?php

class REVIEWTableSeeder extends Seeder {

	public function run()
	{
        // TODO Check if 'Deleted' is needed in this way
        $dbEntries = array(
            array('ForUserProfileID' => '3', 'FromUserProfileID' => '2', 'DateCreated' => '2015-06-18 11:47:15', 'Deleted' => '0', 'Text' => 'Top persoon'),
        );

        // TODO Replace this code with a model
        DB::table('REVIEW')->insert($dbEntries);
	}

}