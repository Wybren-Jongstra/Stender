<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSKILLOPTIONTable4 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('SKILL_OPTION', function(Blueprint $table)
		{
			$table->integer('SkillOptionID', true);
			$table->integer('SkillKindID')->index('fk_SKILL_OPTION_SKILL_KIND1_idx');
			$table->string('Name', 100)->unique('Name_UNIQUE');
			$table->string('Description', 200);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('SKILL_OPTION');
	}

}
