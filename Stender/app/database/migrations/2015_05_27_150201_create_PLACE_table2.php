<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePLACETable2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PLACE', function(Blueprint $table)
		{
			$table->integer('SkillID', true);
			$table->integer('UserProfileID')->index('fk_SKILL_USER_PROFILE1_idx');
			$table->integer('PlaceOptionID')->index('fk_PLACE_PLACE_OPTION1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('PLACE');
	}

}
