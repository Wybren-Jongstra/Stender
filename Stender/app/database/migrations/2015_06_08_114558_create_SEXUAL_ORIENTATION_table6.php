<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSEXUALORIENTATIONTable6 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('SEXUAL_ORIENTATION', function(Blueprint $table)
		{
			$table->integer('SexualOrientationID', true);
			$table->string('Name', 21)->unique('Name_UNIQUE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('SEXUAL_ORIENTATION');
	}

}
