<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateINTERESTTable4 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('INTEREST', function(Blueprint $table)
		{
			$table->integer('InterestID', true);
			$table->integer('UserProfileID')->index('fk_INTEREST_USER_PROFILE1_idx');
			$table->integer('InterestOptionID')->index('fk_INTEREST_INTEREST_OPTION1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('INTEREST');
	}

}
