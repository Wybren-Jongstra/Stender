<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUSERVOTETable5 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('USER_VOTE', function(Blueprint $table)
		{
			$table->foreign('ForUserID', 'fk_USER_VOTE_USER1')->references('UserID')->on('USER')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('FromUserID', 'fk_USER_VOTE_USER2')->references('UserID')->on('USER')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('USER_VOTE', function(Blueprint $table)
		{
			$table->dropForeign('fk_USER_VOTE_USER1');
			$table->dropForeign('fk_USER_VOTE_USER2');
		});
	}

}
