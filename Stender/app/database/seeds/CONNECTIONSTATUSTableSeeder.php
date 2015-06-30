<?php

class CONNECTIONSTATUSTableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
            array('Name' => 'waiting'),
            array('Name' => 'approved'),
            array('Name' => 'declined'),
        );

        DB::table('CONNECTION_STATUS')->insert($dbEntries);
	}

}