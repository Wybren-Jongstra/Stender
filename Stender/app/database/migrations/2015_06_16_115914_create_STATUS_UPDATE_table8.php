<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSTATUSUPDATETable8 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('STATUS_UPDATE', function(Blueprint $table)
		{
			$table->integer('StatusUpdateID', true);
			$table->integer('UserID')->index('fk_STATUS_UPDATE_USER1_idx');
			$table->dateTime('DateCreated');
			$table->dateTime('DateUpdated')->nullable();
			$table->boolean('Deleted');
			$table->string('Text');
			$table->string('ImageUrlPart')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('STATUS_UPDATE');
	}

}
