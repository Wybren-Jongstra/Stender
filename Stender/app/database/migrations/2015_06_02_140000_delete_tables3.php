<?php

use App\Database\Migrations\AbstractDeleteTables;

/**
 * Class DropTables3
 * Drops the tables of the previous database version.
 */
class DeleteTables3 extends AbstractDeleteTables {

    protected function getMigrationObjectsArray()
    {
        return array (
            new CreateCONNECTIONSTATUSTable3(),
            new CreateCONNECTIONTable3(),
            new CreateEDUCATIONTable3(),
            new CreateEXTERNALACCOUNTKINDTable3(),
            new CreateEXTERNALACCOUNTTable3(),
            new CreateGENDERTable3(),
            new CreateHASHTAGKINDTable3(),
            new CreateHASHTAGOPTIONTable3(),
            new CreateHASHTAGTable3(),
            new CreateINTERESTKINDTable3(),
            new CreateINTERESTOPTIONTable3(),
            new CreateINTERESTTable3(),
            new CreatePHONENUMBERKINDTable3(),
            new CreatePHONENUMBERTable3(),
            new CreateREVIEWTable3(),
            new CreateSEXUALORIENTATIONTable3(),
            new CreateSKILLKINDTable3(),
            new CreateSKILLOPTIONTable3(),
            new CreateSKILLTable3(),
            new CreateUSERKINDTable3(),
            new CreateUSERPROFILETable3(),
            new CreateUSERVOTETable3(),
            new CreateUSERTable3(),
            new AddForeignKeysToCONNECTIONTable3(),
            new AddForeignKeysToEXTERNALACCOUNTTable3(),
            new AddForeignKeysToHASHTAGOPTIONTable3(),
            new AddForeignKeysToHASHTAGTable3(),
            new AddForeignKeysToINTERESTOPTIONTable3(),
            new AddForeignKeysToINTERESTTable3(),
            new AddForeignKeysToPHONENUMBERTable3(),
            new AddForeignKeysToREVIEWTable3(),
            new AddForeignKeysToSKILLOPTIONTable3(),
            new AddForeignKeysToSKILLTable3(),
            new AddForeignKeysToUSERPROFILETable3(),
            new AddForeignKeysToUSERVOTETable3(),
            new AddForeignKeysToUSERTable3(),
        );
    }

}
