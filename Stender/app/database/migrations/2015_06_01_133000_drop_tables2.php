<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class DropTables
 * Drops the tables of the previous database version.
 */
class DropTables2 extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
	public function up()
	{
        // Check if there are no app tables in the database so that
        // the up method deactivates automatically without breaking php artisan migrate.
        // Use the default auth table for that check.
        // Throw an error when this check is not possible. So when the configuration for the auth table is not found.
        if(is_null(Config::get('auth.table')))
        {
            throw new Exception('Configuration for auth table not found!');
        }
        elseif(! Schema::hasTable(Config::get('auth.table')))
        {
            return;
        }

        $migrationObjects = array
        (
            new CreateCONNECTIONTable2(),
            new CreateCONNECTIONSTATUSTable2(),
            new CreateEDUCATIONTable2(),
            new CreateEXTERNALACCOUNTTable2(),
            new CreateEXTERNALACCOUNTKINDTable2(),
            new CreateGENDERTable2(),
            new CreateHASHTAGTable2(),
            new CreateHASHTAGKINDTable2(),
            new CreateINTERESTTable2(),
            new CreateINTERESTKINDTable2(),
            new CreateINTERESTOPTIONTable2(),
            new CreatePHONENUMBERTable2(),
            new CreatePHONENUMBERKINDTable2(),
            new CreateREVIEWTable2(),
            new CreateSEXUALORIENTATIONTable2(),
            new CreateSKILLTable2(),
            new CreateSKILLKINDTable2(),
            new CreateSKILLOPTIONTable2(),
            new CreateUSERTable2(),
            new CreateUSERKINDTable2(),
            new CreateUSERPROFILETable2(),
            new CreateUSERVOTETable2(),
            new AddForeignKeysToCONNECTIONTable2(),
            new AddForeignKeysToEXTERNALACCOUNTTable2(),
            new AddForeignKeysToHASHTAGTable2(),
            new AddForeignKeysToINTERESTTable2(),
            new AddForeignKeysToINTERESTOPTIONTable2(),
            new AddForeignKeysToPHONENUMBERTable2(),
            new AddForeignKeysToREVIEWTable2(),
            new AddForeignKeysToSKILLTable2(),
            new AddForeignKeysToSKILLOPTIONTable2(),
            new AddForeignKeysToUSERTable2(),
            new AddForeignKeysToUSERPROFILETable2(),
            new AddForeignKeysToUSERVOTETable2(),
        );

        // Loop backwards because the foreign keys must first be removed.
        for($i = (count($migrationObjects) - 1); $i >= 0; $i--)
        {
            // down method rolls back the migration file
            $migrationObjects[$i]->down();
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
