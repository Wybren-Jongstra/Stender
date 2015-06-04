<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateREVIEWTable5 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('REVIEW', function(Blueprint $table)
		{
			$table->integer('ReviewID', true);
			$table->integer('ForUserProfileID')->index('fk_REVIEW_USER_PROFILE1_idx');
			$table->integer('FromUserProfileID')->index('fk_REVIEW_USER_PROFILE2_idx');
			$table->dateTime('DateCreated');
			$table->dateTime('DateUpdated')->nullable();
			$table->boolean('Deleted');
			$table->string('Text', 510);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('REVIEW');
	}

}
