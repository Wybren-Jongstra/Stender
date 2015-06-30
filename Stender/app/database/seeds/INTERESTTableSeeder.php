<?php

class INTERESTTableSeeder extends Seeder {

	public function run()
	{
        $dbEntries = array(
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'PuurIDee'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Mannen dingen.'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Handelsprijzen.nl'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'RKpromotions'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Feestcafe Gelegenheid'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Kampioensbandje'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Frenk de Boer'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'View for a Day'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Suits'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'WoodWatch'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Streekbedrijven.nl'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Bouwkundig Ontwerp- en Tekenbureau R. van der Burgh'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'BETSTAY'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Bier College'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Facebook for Every Phone'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Hans Stuive'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Raúl dolt keeper op briljante wijze'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'U2'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Coldplay'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Johan Cruyff'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Andy Schleck'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Leopard Cycling'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'AFC Ajax'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'Niels Geusebroek'),
            array('UserProfileID' => '2', 'AccountKindID' => '3', 'Value' => 'The Killers'),
        );

        // TODO Replace this code with a model
        DB::table('INTEREST')->insert($dbEntries);
	}

}