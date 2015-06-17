<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToINTERESTTable8 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('INTEREST', function(Blueprint $table)
		{
			$table->foreign('AccountKindID', 'fk_INTEREST_ACCOUNT_KIND1')->references('AccountKindID')->on('ACCOUNT_KIND')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('UserProfileID', 'fk_INTEREST_USER_PROFILE1')->references('UserProfileID')->on('USER_PROFILE')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign('fk_INTEREST_ACCOUNT_KIND1');
			$table->dropForeign('fk_INTEREST_USER_PROFILE1');
		});
	}

}
