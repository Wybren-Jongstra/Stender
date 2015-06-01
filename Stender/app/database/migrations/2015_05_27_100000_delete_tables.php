<?php

use App\Database\Migrations\AbstractDeleteTables;

/**
 * Class DropTables
 * Drops the tables of the previous database version.
 */
class DeleteTables extends AbstractDeleteTables {

    protected function getMigrationObjectsArray()
    {
        return array(
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
    }

}
