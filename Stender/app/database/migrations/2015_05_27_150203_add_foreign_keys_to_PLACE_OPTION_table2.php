<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPLACEOPTIONTable2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('PLACE_OPTION', function(Blueprint $table)
		{
			$table->foreign('PlaceKindID', 'fk_PLACE_PLACE_KIND1')->references('PlaceKindID')->on('PLACE_KIND')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('PLACE_OPTION', function(Blueprint $table)
		{
			$table->dropForeign('fk_PLACE_PLACE_KIND1');
		});
	}

}
