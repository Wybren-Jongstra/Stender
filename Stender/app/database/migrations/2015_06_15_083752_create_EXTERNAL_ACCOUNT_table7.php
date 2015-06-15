<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEXTERNALACCOUNTTable7 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EXTERNAL_ACCOUNT', function(Blueprint $table)
		{
			$table->integer('ExternalAccountID', true);
			$table->integer('ExternalAccountKindID')->index('fk_EXTERNAL_ACCOUNT_EXTERNAL_ACCOUNT_KIND1_idx');
			$table->integer('UserID')->index('fk_EXTERNAL_ACCOUNT_USER1_idx');
			$table->dateTime('DateCreated');
			$table->dateTime('DateUpdated')->nullable();
			$table->string('Token')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('EXTERNAL_ACCOUNT');
	}

}
