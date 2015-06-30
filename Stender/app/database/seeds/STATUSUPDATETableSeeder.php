<?php

class STATUSUPDATETableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
            array('UserID' => '4', 'DateCreated' => '2015-06-18 08:07:57', 'Deleted' => '0', 'Text' => 'Lekker piano gespeeld =D', 'ImageUrlPart' => 'uploads/test_pictures/4_Fg9vIO_message_picture_mark.jpg'),
            array('UserID' => '2', 'DateCreated' => '2015-06-18 08:35:12', 'Deleted' => '0', 'Text' => 'Druk aan het testen en het voorbereiden op de presentatie', 'ImageUrlPart' => NULL),
            array('UserID' => '1', 'DateCreated' => '2015-06-18 08:36:58', 'Deleted' => '0', 'Text' => 'Geweldige actie van Mamma Mia... 2 Pizza\'s halen 1 betalen!!!!!!\r\nAlleen Maandag 32 Juni!', 'ImageUrlPart' => NULL),
        );

        DB::table('STATUS_UPDATE')->insert($dbEntries);
	}

}