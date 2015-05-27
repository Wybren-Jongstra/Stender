<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class DropTables
 * Drops the tables of the previous database version.
 */
class DropTables extends Migration {

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
            new CreateCONNECTIONKINDTable(),
            new CreateCONNECTIONSTATUSTable(),
            new CreateCONNECTIONTable(),
            new CreateEXTERNALACCOUNTKINDTable(),
            new CreateEXTERNALACCOUNTTable(),
            new CreateGENDERTable(),
            new CreateINTERESTKINDTable(),
            new CreateINTERESTOPTIONTable(),
            new CreateINTERESTTable(),
            new CreatePHONENUMBERKINDTable(),
            new CreatePHONENUMBERTable(),
            new CreatePLACEKINDTable(),
            new CreatePLACEOPTIONTable(),
            new CreatePLACETable(),
            new CreateREVIEWTable(),
            new CreateSEXUALORIENTATIONTable(),
            new CreateSKILLKINDTable(),
            new CreateSKILLOPTIONTable(),
            new CreateSKILLTable(),
            new CreateUSERKINDTable(),
            new CreateUSERPROFILETable(),
            new CreateUSERVOTETable(),
            new CreateUSERTable(),
            new AddForeignKeysToCONNECTIONTable(),
            new AddForeignKeysToEXTERNALACCOUNTTable(),
            new AddForeignKeysToINTERESTOPTIONTable(),
            new AddForeignKeysToINTERESTTable(),
            new AddForeignKeysToPHONENUMBERTable(),
            new AddForeignKeysToPLACEOPTIONTable(),
            new AddForeignKeysToPLACETable(),
            new AddForeignKeysToREVIEWTable(),
            new AddForeignKeysToSKILLOPTIONTable(),
            new AddForeignKeysToSKILLTable(),
            new AddForeignKeysToUSERPROFILETable(),
            new AddForeignKeysToUSERVOTETable(),
            new AddForeignKeysToUSERTable(),
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
