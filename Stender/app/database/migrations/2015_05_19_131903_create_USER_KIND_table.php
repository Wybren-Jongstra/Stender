<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUSERKINDTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('USER_KIND', function(Blueprint $table)
		{
			$table->integer('UserKindID', true);
			$table->string('Name', 15)->unique('Name_UNIQUE');
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
		Schema::drop('USER_KIND');
	}

}
