<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSKILLTable7 extends Migration {

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
			$table->integer('AccountKindID')->index('fk_SKILL_ACCOUNT_KIND1_idx');
			$table->string('Value');
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
