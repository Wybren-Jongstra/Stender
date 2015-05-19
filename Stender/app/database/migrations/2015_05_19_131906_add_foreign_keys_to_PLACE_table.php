<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPLACETable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('PLACE', function(Blueprint $table)
		{
			$table->foreign('PlaceOptionID', 'fk_PLACE_PLACE_OPTION1')->references('PlaceOptionID')->on('PLACE_OPTION')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('UserProfileID', 'fk_SKILL_USER_PROFILE10')->references('UserProfileID')->on('USER_PROFILE')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('PLACE', function(Blueprint $table)
		{
			$table->dropForeign('fk_PLACE_PLACE_OPTION1');
			$table->dropForeign('fk_SKILL_USER_PROFILE10');
		});
	}

}
