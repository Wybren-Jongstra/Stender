<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateINTERESTKINDTable3 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('INTEREST_KIND', function(Blueprint $table)
		{
			$table->integer('InterestKindID', true);
			$table->string('Name', 15)->unique('Name_UNIQUE');
			$table->string('Description', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('INTEREST_KIND');
	}

}
