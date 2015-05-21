<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEXTERNALACCOUNTKINDTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EXTERNAL_ACCOUNT_KIND', function(Blueprint $table)
		{
			$table->integer('ExternalAccountKindID', true);
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
		Schema::drop('EXTERNAL_ACCOUNT_KIND');
	}

}
