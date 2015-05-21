<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUSERVOTETable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('USER_VOTE', function(Blueprint $table)
		{
			$table->integer('UserVoteID', true);
			$table->integer('ForUserID')->index('fk_USER_VOTE_USER1_idx');
			$table->integer('FromUserID')->index('fk_USER_VOTE_USER2_idx');
			$table->dateTime('DateCreated');
			$table->dateTime('DateUpdated')->nullable();
			$table->boolean('Upvote');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('USER_VOTE');
	}

}
