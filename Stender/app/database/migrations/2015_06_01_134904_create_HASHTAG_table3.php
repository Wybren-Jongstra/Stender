<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHASHTAGTable3 extends Migration {

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
			$table->integer('HashtagOptionID')->index('fk_HASHTAG_HASHTAG1_idx');
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
