<?php

use App\Database\Migrations\AbstractDeleteTables;

/**
 * Class DropTables2
 * Drops the tables of the previous database version.
 */
class DeleteTables2 extends AbstractDeleteTables {

    protected function getMigrationObjectsArray()
    {
        return array (
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
    }

}
