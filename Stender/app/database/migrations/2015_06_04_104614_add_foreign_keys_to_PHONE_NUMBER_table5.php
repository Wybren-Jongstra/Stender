<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPHONENUMBERTable5 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('PHONE_NUMBER', function(Blueprint $table)
		{
			$table->foreign('PhoneNumberKindID', 'fk_PHONE_NUMBER_PHONE_NUMBER_KIND')->references('PhoneNumberKindID')->on('PHONE_NUMBER_KIND')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('UserDataID', 'fk_PHONE_NUMBER_USER_DATA1')->references('UserProfileID')->on('USER_PROFILE')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('PHONE_NUMBER', function(Blueprint $table)
		{
			$table->dropForeign('fk_PHONE_NUMBER_PHONE_NUMBER_KIND');
			$table->dropForeign('fk_PHONE_NUMBER_USER_DATA1');
		});
	}

}
