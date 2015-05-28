<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePLACEKINDTable2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PLACE_KIND', function(Blueprint $table)
		{
			$table->integer('PlaceKindID', true);
			$table->string('Name', 20)->unique('Name_UNIQUE');
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
		Schema::drop('PLACE_KIND');
	}

}
