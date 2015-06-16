<?php

use App\Database\Migrations\AbstractDeleteTables;

/**
 * Drops the tables of the previous database version.
 *
 */
class DeleteTables7 extends AbstractDeleteTables {

    protected function getMigrationObjectsArray()
    {
        return array (
            new CreateACCOUNTKINDTable7(),
            new CreateCONNECTIONSTATUSTable7(),
            new CreateCONNECTIONTable7(),
            new CreateEDUCATIONTable7(),
            new CreateEXTERNALACCOUNTKINDTable7(),
            new CreateEXTERNALACCOUNTTable7(),
            new CreateGENDERTable7(),
            new CreateHASHTAGTable7(),
            new CreateINTERESTTable7(),
            new CreatePHONENUMBERKINDTable7(),
            new CreatePHONENUMBERTable7(),
            new CreateREVIEWTable7(),
            new CreateSEXUALORIENTATIONTable7(),
            new CreateSKILLTable7(),
            new CreateSTATUSUPDATETable7(),
            new CreateUSERKINDTable7(),
            new CreateUSERPROFILETable7(),
            new CreateUSERVOTETable7(),
            new CreateUSERTable7(),
            new AddForeignKeysToCONNECTIONTable7(),
            new AddForeignKeysToEXTERNALACCOUNTKINDTable7(),
            new AddForeignKeysToEXTERNALACCOUNTTable7(),
            new AddForeignKeysToHASHTAGTable7(),
            new AddForeignKeysToINTERESTTable7(),
            new AddForeignKeysToPHONENUMBERTable7(),
            new AddForeignKeysToREVIEWTable7(),
            new AddForeignKeysToSKILLTable7(),
            new AddForeignKeysToSTATUSUPDATETable7(),
            new AddForeignKeysToUSERPROFILETable7(),
            new AddForeignKeysToUSERVOTETable7(),
            new AddForeignKeysToUSERTable7(),
        );
    }

}
