<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCONNECTIONKINDTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('CONNECTION_KIND', function(Blueprint $table)
		{
			$table->integer('ConnectionKindID', true);
			$table->string('Name', 45)->unique('Name_UNIQUE');
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
		Schema::drop('CONNECTION_KIND');
	}

}
