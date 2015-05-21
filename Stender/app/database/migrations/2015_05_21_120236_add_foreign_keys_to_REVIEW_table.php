<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToREVIEWTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('REVIEW', function(Blueprint $table)
		{
			$table->foreign('ForUserID', 'fk_REVIEW_USER1')->references('UserID')->on('USER')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('FromUserID', 'fk_REVIEW_USER2')->references('UserID')->on('USER')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('REVIEW', function(Blueprint $table)
		{
			$table->dropForeign('fk_REVIEW_USER1');
			$table->dropForeign('fk_REVIEW_USER2');
		});
	}

}
