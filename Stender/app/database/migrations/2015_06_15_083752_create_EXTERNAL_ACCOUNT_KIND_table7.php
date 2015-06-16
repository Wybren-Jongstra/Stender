<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEXTERNALACCOUNTKINDTable7 extends Migration {

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
			$table->integer('AccountKindID')->unique('AccountKindID_UNIQUE');
			$table->integer('PopupHeight');
			$table->integer('PopupWidth');
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
