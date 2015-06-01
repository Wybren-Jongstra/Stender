<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSKILLKINDTable3 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('SKILL_KIND', function(Blueprint $table)
		{
			$table->integer('SkillKindID', true);
			$table->string('Name', 20)->unique('Name_UNIQUE');
			$table->string('Description', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('SKILL_KIND');
	}

}
