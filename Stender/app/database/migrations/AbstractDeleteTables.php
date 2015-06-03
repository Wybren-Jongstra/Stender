<?php namespace App\Database\Migrations;

use Exception;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

/**
 * Class AbstractDeleteTables
 * Drops the tables of a previous database version.
 */
abstract class AbstractDeleteTables extends Migration {

    /**
     * @return array
     */
    abstract protected function getMigrationObjectsArray();

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

        // Loop backwards because the foreign keys must first be removed.
        for($migrationObjects = $this-> getMigrationObjectsArray(), $i = (count($migrationObjects) - 1); $i >= 0; $i--)
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
        // Add back the previous migration files for a working rollback function.
        for($i = 0, $migrationObjects = ($this->getMigrationObjectsArray()), $length = count($migrationObjects); $i < $length; $i++)
        {
            $migrationObjects[$i]->up();
        }
    }

}
