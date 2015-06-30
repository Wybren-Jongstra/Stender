<?php

class EDUCATIONTableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
        	array('Name' => 'Biercollege'),
            array('Name' => 'Informatica (SE)'),
            array('Name' => 'Informatica (TI)'),
            array('Name' => 'Informatica (MMD)'),
            array('Name' => 'Informatica (ICT)'),
            array('Name' => 'Werktuigbouwkunde'),
            array('Name' => 'Hogere Hotel School'),
            array('Name' => 'Economie'),
            array('Name' => 'Wiskunde'),
            array('Name' => 'Geometrie'),
            
        );

        DB::table('EDUCATION')->insert($dbEntries);
	}

}