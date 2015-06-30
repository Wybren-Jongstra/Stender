<?php

class SKILLTableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'PHP'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'XHTML'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'MySQL'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'JAVA'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'Adobe Flash'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'Adobe Photoshop'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'Adobe Illustrator'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'WPF'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'XAML'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'Android Development'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'C#'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'XML'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'JavaScript'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'jQuery'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'English'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'Teamwork'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'Social Media'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'Project Management'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'CSS'),
            array('UserProfileID' => '2', 'AccountKindID' => '4', 'Value' => 'Databases'),
        );

        // TODO Replace this code with a model
        DB::table('SKILL')->insert($dbEntries);
	}

}