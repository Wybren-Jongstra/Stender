<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUSERTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('USER', function(Blueprint $table)
		{
			$table->foreign('UserKindID', 'fk_USER_USER_RIGHTS1')->references('UserKindID')->on('USER_KIND')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('USER', function(Blueprint $table)
		{
			$table->dropForeign('fk_USER_USER_RIGHTS1');
		});
	}

}
