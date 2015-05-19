<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUSERPROFILETable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('USER_PROFILE', function(Blueprint $table)
		{
			$table->foreign('GenderID', 'fk_USER_DATA_GENDER1')->references('GenderID')->on('GENDER')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('UserID', 'fk_USER_DATA_USER1')->references('UserID')->on('USER')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('SexualOrientationID', 'fk_USER_PROFILE_SEXUAL_ORIENTATION1')->references('SexualOrientationID')->on('SEXUAL_ORIENTATION')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('USER_PROFILE', function(Blueprint $table)
		{
			$table->dropForeign('fk_USER_DATA_GENDER1');
			$table->dropForeign('fk_USER_DATA_USER1');
			$table->dropForeign('fk_USER_PROFILE_SEXUAL_ORIENTATION1');
		});
	}

}
