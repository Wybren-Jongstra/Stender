<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHASHTAGTable6 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('HASHTAG', function(Blueprint $table)
		{
			$table->integer('HashtagID', true);
			$table->integer('UserProfileID')->index('fk_SKILL_USER_PROFILE1_idx');
			$table->integer('AccountKindID')->index('fk_HASHTAG_ACCOUNT_KIND1_idx');
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
		Schema::drop('HASHTAG');
	}

}
