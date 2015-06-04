<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePHONENUMBERKINDTable5 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PHONE_NUMBER_KIND', function(Blueprint $table)
		{
			$table->integer('PhoneNumberKindID', true);
			$table->string('Name', 10)->unique('Name_UNIQUE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('PHONE_NUMBER_KIND');
	}

}
