<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHASHTAGTable5 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('HASHTAG', function(Blueprint $table)
		{
			$table->foreign('UserProfileID', 'fk_SKILL_USER_PROFILE10')->references('UserProfileID')->on('USER_PROFILE')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('AccountKindID', 'fk_HASHTAG_ACCOUNT_KIND1')->references('AccountKindID')->on('ACCOUNT_KIND')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('HASHTAG', function(Blueprint $table)
		{
			$table->dropForeign('fk_SKILL_USER_PROFILE10');
			$table->dropForeign('fk_HASHTAG_ACCOUNT_KIND1');
		});
	}

}
