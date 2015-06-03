<?php

class ACCOUNTKINDTableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
            array('Name' => 'Stender'),
            array('Name' => 'Twitter'),
            array('Name' => 'Facebook'),
            array('Name' => 'LinkedIn'),
        );

        // TODO Replace this code with a model
        DB::table('ACCOUNT_KIND')->insert($dbEntries);
	}

}