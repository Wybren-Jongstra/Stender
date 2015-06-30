<?php

class HASHTAGTableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
            array('UserProfileID' => '2', 'AccountKindID' => '2', 'Value' => 'Eredivisie'),
            array('UserProfileID' => '2', 'AccountKindID' => '2', 'Value' => 'Ajax'),
            array('UserProfileID' => '2', 'AccountKindID' => '2', 'Value' => '3FM'),
            array('UserProfileID' => '2', 'AccountKindID' => '2', 'Value' => 'tbt'),
            array('UserProfileID' => '2', 'AccountKindID' => '2', 'Value' => 'Filesofietje'),
            array('UserProfileID' => '2', 'AccountKindID' => '2', 'Value' => 'JPN'),
            array('UserProfileID' => '2', 'AccountKindID' => '2', 'Value' => 'WKdroom'),
            array('UserProfileID' => '2', 'AccountKindID' => '2', 'Value' => 'ATeam'),
        );

        // TODO Replace this code with a model
        DB::table('HASHTAG')->insert($dbEntries);
	}

}