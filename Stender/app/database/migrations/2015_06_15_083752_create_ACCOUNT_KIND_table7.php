<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateACCOUNTKINDTable7 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ACCOUNT_KIND', function(Blueprint $table)
		{
			$table->integer('AccountKindID', true);
			$table->string('Name', 25)->unique('Name_UNIQUE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ACCOUNT_KIND');
	}

}
