<?php

use App\Database\Migrations\AbstractDeleteTables;

/**
 * Class DropTables5
 * Drops the tables of the previous database version.
 */
class DeleteTables5 extends AbstractDeleteTables {

    protected function getMigrationObjectsArray()
    {
        return array (
            new CreateACCOUNTKINDTable5(),
            new CreateCONNECTIONSTATUSTable5(),
            new CreateCONNECTIONTable5(),
            new CreateEDUCATIONTable5(),
            new CreateEXTERNALACCOUNTTable5(),
            new CreateGENDERTable5(),
            new CreateHASHTAGTable5(),
            new CreateINTERESTTable5(),
            new CreatePHONENUMBERKINDTable5(),
            new CreatePHONENUMBERTable5(),
            new CreateREVIEWTable5(),
            new CreateSEXUALORIENTATIONTable5(),
            new CreateSKILLTable5(),
            new CreateUSERKINDTable5(),
            new CreateUSERPROFILETable5(),
            new CreateUSERVOTETable5(),
            new CreateUSERTable5(),
            new AddForeignKeysToCONNECTIONTable5(),
            new AddForeignKeysToEXTERNALACCOUNTTable5(),
            new AddForeignKeysToHASHTAGTable5(),
            new AddForeignKeysToINTERESTTable5(),
            new AddForeignKeysToPHONENUMBERTable5(),
            new AddForeignKeysToREVIEWTable5(),
            new AddForeignKeysToSKILLTable5(),
            new AddForeignKeysToUSERPROFILETable5(),
            new AddForeignKeysToUSERVOTETable5(),
            new AddForeignKeysToUSERTable5(),
        );
    }

}
