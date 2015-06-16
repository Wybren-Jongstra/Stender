<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUSERTable8 extends Migration {

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
			$table->integer('UserProfileID')->unique('UserProfileID_UNIQUE');
			$table->dateTime('DateCreated');
			$table->dateTime('LastLogin')->nullable();
			$table->string('Email', 254)->unique('Email_UNIQUE');
			$table->string('Password', 128);
			$table->string('ActivationToken', 128)->unique('ActivationToken_UNIQUE');
			$table->boolean('Activated');
			$table->string('ResetToken', 128)->nullable()->unique('ResetToken_UNIQUE');
			$table->string('RememberToken', 100)->nullable()->unique('RememberToken_UNIQUE');
			$table->boolean('Inactive');
			$table->boolean('Deleted');
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
