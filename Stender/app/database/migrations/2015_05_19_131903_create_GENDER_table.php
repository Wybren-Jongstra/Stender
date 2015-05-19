<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGENDERTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('GENDER', function(Blueprint $table)
		{
			$table->integer('GenderID', true);
			$table->string('Name', 21)->unique('Name_UNIQUE');
			$table->string('Description', 100)->unique('Description_UNIQUE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('GENDER');
	}

}
