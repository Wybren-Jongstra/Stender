<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSTATUSUPDATETable7 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('STATUS_UPDATE', function(Blueprint $table)
		{
			$table->foreign('UserID', 'fk_STATUS_UPDATE_USER1')->references('UserID')->on('USER')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('STATUS_UPDATE', function(Blueprint $table)
		{
			$table->dropForeign('fk_STATUS_UPDATE_USER1');
		});
	}

}
