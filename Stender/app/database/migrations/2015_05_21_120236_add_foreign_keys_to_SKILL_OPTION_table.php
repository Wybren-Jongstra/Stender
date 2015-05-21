<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSKILLOPTIONTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('SKILL_OPTION', function(Blueprint $table)
		{
			$table->foreign('SkillKindID', 'fk_SKILL_OPTION_SKILL_KIND1')->references('SkillKindID')->on('SKILL_KIND')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('SKILL_OPTION', function(Blueprint $table)
		{
			$table->dropForeign('fk_SKILL_OPTION_SKILL_KIND1');
		});
	}

}
