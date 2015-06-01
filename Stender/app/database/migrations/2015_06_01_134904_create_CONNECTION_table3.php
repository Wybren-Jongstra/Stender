<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCONNECTIONTable3 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('CONNECTION', function(Blueprint $table)
		{
			$table->integer('ConnectionID', true);
			$table->integer('ForUserID')->index('fk_CONNECTION_USER1_idx');
			$table->integer('FromUserID')->index('fk_CONNECTION_USER2_idx');
			$table->integer('ConnectionStatusID')->index('fk_CONNECTION_CONNECTION_STATUS1_idx');
			$table->dateTime('DateCreated');
			$table->dateTime('DateUpdated')->nullable();
			$table->boolean('Unconnected');
			$table->string('Message');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('CONNECTION');
	}

}
