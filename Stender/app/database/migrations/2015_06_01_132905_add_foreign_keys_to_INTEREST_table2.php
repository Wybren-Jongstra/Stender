<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToINTERESTTable2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('INTEREST', function(Blueprint $table)
		{
			$table->foreign('UserProfileID', 'fk_INTEREST_USER_PROFILE1')->references('UserProfileID')->on('USER_PROFILE')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('InterestOptionID', 'fk_INTEREST_INTEREST_OPTION1')->references('InterestOptionID')->on('INTEREST_OPTION')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('INTEREST', function(Blueprint $table)
		{
			$table->dropForeign('fk_INTEREST_USER_PROFILE1');
			$table->dropForeign('fk_INTEREST_INTEREST_OPTION1');
		});
	}

}
