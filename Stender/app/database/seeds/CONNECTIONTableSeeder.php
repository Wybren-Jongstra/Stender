<?php

class CONNECTIONTableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
            array('ForUserID' => '1', 'FromUserID' => '2', 'ConnectionStatusID' => '2', 'DateCreated' => '2015-06-18 07:49:31', 'DateUpdated' => '2015-06-18 07:49:31', 'Unconnected' => '0', 'Message' => ''),
            array('ForUserID' => '3', 'FromUserID' => '2', 'ConnectionStatusID' => '2', 'DateCreated' => '2015-06-18 07:50:15', 'DateUpdated' => '2015-06-18 07:50:15', 'Unconnected' => '0', 'Message' => ''),
            array('ForUserID' => '4', 'FromUserID' => '1', 'ConnectionStatusID' => '2', 'DateCreated' => '2015-06-18 08:23:55', 'DateUpdated' => '2015-06-18 08:23:55', 'Unconnected' => '0', 'Message' => ''),
        );

        DB::table('CONNECTION')->insert($dbEntries);
	}

}