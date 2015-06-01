<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSKILLTable3 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('SKILL', function(Blueprint $table)
		{
			$table->integer('SkillID', true);
			$table->integer('UserProfileID')->index('fk_SKILL_USER_PROFILE1_idx');
			$table->integer('SkillOptionID')->index('fk_SKILL_SKILL_OPTION1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('SKILL');
	}

}
