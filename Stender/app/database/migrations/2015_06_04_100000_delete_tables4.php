<?php

use App\Database\Migrations\AbstractDeleteTables;

/**
 * Drops the tables of the previous database version.
 *
 */
class DeleteTables4 extends AbstractDeleteTables {

    protected function getMigrationObjectsArray()
    {
        return array (
            new CreateACCOUNTKINDTable4(),
            new CreateCONNECTIONSTATUSTable4(),
            new CreateCONNECTIONTable4(),
            new CreateEDUCATIONTable4(),
            new CreateEXTERNALACCOUNTTable4(),
            new CreateGENDERTable4(),
            new CreateHASHTAGTable4(),
            new CreateINTERESTKINDTable4(),
            new CreateINTERESTOPTIONTable4(),
            new CreateINTERESTTable4(),
            new CreatePHONENUMBERKINDTable4(),
            new CreatePHONENUMBERTable4(),
            new CreateREVIEWTable4(),
            new CreateSEXUALORIENTATIONTable4(),
            new CreateSKILLKINDTable4(),
            new CreateSKILLOPTIONTable4(),
            new CreateSKILLTable4(),
            new CreateUSERKINDTable4(),
            new CreateUSERPROFILETable4(),
            new CreateUSERVOTETable4(),
            new CreateUSERTable4(),
            new AddForeignKeysToCONNECTIONTable4(),
            new AddForeignKeysToEXTERNALACCOUNTTable4(),
            new AddForeignKeysToHASHTAGTable4(),
            new AddForeignKeysToINTERESTOPTIONTable4(),
            new AddForeignKeysToINTERESTTable4(),
            new AddForeignKeysToPHONENUMBERTable4(),
            new AddForeignKeysToREVIEWTable4(),
            new AddForeignKeysToSKILLOPTIONTable4(),
            new AddForeignKeysToSKILLTable4(),
            new AddForeignKeysToUSERPROFILETable4(),
            new AddForeignKeysToUSERVOTETable4(),
            new AddForeignKeysToUSERTable4(),
        );
    }

}
