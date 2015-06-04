<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCONNECTIONTable5 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('CONNECTION', function(Blueprint $table)
		{
			$table->foreign('ConnectionStatusID', 'fk_CONNECTION_CONNECTION_STATUS1')->references('ConnectionStatusID')->on('CONNECTION_STATUS')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('ForUserID', 'fk_CONNECTION_USER1')->references('UserID')->on('USER')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('FromUserID', 'fk_CONNECTION_USER2')->references('UserID')->on('USER')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('CONNECTION', function(Blueprint $table)
		{
			$table->dropForeign('fk_CONNECTION_CONNECTION_STATUS1');
			$table->dropForeign('fk_CONNECTION_USER1');
			$table->dropForeign('fk_CONNECTION_USER2');
		});
	}

}
