<?php

class EXTERNALACCOUNTKINDTableSeeder extends Seeder {

	public function run()
	{
        // Grab only external accounts
        // Makes use of the database object for better performance
        $accountKinds = DB::table('ACCOUNT_KIND')->where('Name', '!=', 'Stender')->get();

        // Fill dbEntries array
        $dbEntries = array();
        foreach($accountKinds as $accountKind)
        {
            // Create a new row
            $row = array();

            // Fields that are customized for each external account
            $accountKindName = $accountKind->Name;
            switch ($accountKindName)
            {
                case 'Twitter':
                    $row['PopupHeight'] = 645;
                    $row['PopupWidth'] = 780;
                    break;
                case 'Facebook':
                    $row['PopupHeight'] = 370;
                    $row['PopupWidth'] = 555;
                    break;
                case 'LinkedIn':
                    $row['PopupHeight'] = 645;
                    $row['PopupWidth'] = 510;
                    break;
                default:
                    throw new Exception('External account ' . $accountKindName . ' not supported in ' . __CLASS__);
            }

            // Remaining fields
            $row['AccountKindID'] = $accountKind->AccountKindID;

            // Add the row
            $dbEntries[] = $row;
        }

        // Seed table
        DB::table('EXTERNAL_ACCOUNT_KIND')->insert($dbEntries);
	}

}