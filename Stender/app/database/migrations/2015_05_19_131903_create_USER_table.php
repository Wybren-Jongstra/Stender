<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUSERTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('USER', function(Blueprint $table)
		{
			$table->integer('UserID', true);
			$table->integer('UserKindID')->index('fk_USER_USER_RIGHTS1_idx');
			$table->dateTime('DateCreated');
			$table->dateTime('LastLogin')->nullable();
			$table->string('Email', 254)->unique('Email_UNIQUE');
			$table->string('Password', 128);
			$table->boolean('Activated');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('USER');
	}

}
