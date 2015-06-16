<?php

use App\Database\Migrations\AbstractDeleteTables;

/**
 * Class DropTables6
 * Drops the tables of the previous database version.
 */
class DeleteTables6 extends AbstractDeleteTables {

    protected function getMigrationObjectsArray()
    {
        return array (
            new CreateACCOUNTKINDTable6(),
            new CreateCONNECTIONSTATUSTable6(),
            new CreateCONNECTIONTable6(),
            new CreateEDUCATIONTable6(),
            new CreateEXTERNALACCOUNTTable6(),
            new CreateGENDERTable6(),
            new CreateHASHTAGTable6(),
            new CreateINTERESTTable6(),
            new CreatePHONENUMBERKINDTable6(),
            new CreatePHONENUMBERTable6(),
            new CreateREVIEWTable6(),
            new CreateSEXUALORIENTATIONTable6(),
            new CreateSKILLTable6(),
            new CreateSTATUSUPDATETable6(),
            new CreateUSERKINDTable6(),
            new CreateUSERPROFILETable6(),
            new CreateUSERVOTETable6(),
            new CreateUSERTable6(),
            new AddForeignKeysToCONNECTIONTable6(),
            new AddForeignKeysToEXTERNALACCOUNTTable6(),
            new AddForeignKeysToHASHTAGTable6(),
            new AddForeignKeysToINTERESTTable6(),
            new AddForeignKeysToPHONENUMBERTable6(),
            new AddForeignKeysToREVIEWTable6(),
            new AddForeignKeysToSKILLTable6(),
            new AddForeignKeysToSTATUSUPDATETable6(),
            new AddForeignKeysToUSERPROFILETable6(),
            new AddForeignKeysToUSERVOTETable6(),
            new AddForeignKeysToUSERTable6(),
        );
    }

}
