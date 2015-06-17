<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCONNECTIONSTATUSTable8 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('CONNECTION_STATUS', function(Blueprint $table)
		{
			$table->integer('ConnectionStatusID', true);
			$table->string('Name', 20)->unique('Name_UNIQUE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('CONNECTION_STATUS');
	}

}
