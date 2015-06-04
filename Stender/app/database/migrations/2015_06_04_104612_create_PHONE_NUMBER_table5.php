<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePHONENUMBERTable5 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PHONE_NUMBER', function(Blueprint $table)
		{
			$table->integer('PhoneNumberID', true);
			$table->integer('UserDataID')->index('fk_PHONE_NUMBER_USER_DATA1_idx');
			$table->integer('PhoneNumberKindID')->index('fk_PHONE_NUMBER_PHONE_NUMBER_KIND_idx');
			$table->string('PhoneNumber', 12);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('PHONE_NUMBER');
	}

}
