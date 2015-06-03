<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSKILLTable4 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('SKILL', function(Blueprint $table)
		{
			$table->foreign('UserProfileID', 'fk_SKILL_USER_PROFILE1')->references('UserProfileID')->on('USER_PROFILE')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('SkillOptionID', 'fk_SKILL_SKILL_OPTION1')->references('SkillOptionID')->on('SKILL_OPTION')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('SKILL', function(Blueprint $table)
		{
			$table->dropForeign('fk_SKILL_USER_PROFILE1');
			$table->dropForeign('fk_SKILL_SKILL_OPTION1');
		});
	}

}
