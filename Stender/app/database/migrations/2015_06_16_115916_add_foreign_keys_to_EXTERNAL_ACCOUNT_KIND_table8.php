<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEXTERNALACCOUNTKINDTable8 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EXTERNAL_ACCOUNT_KIND', function(Blueprint $table)
		{
			$table->foreign('AccountKindID', 'fk_EXTERNAL_ACCOUNT_KIND_ACCOUNT_KIND1')->references('AccountKindID')->on('ACCOUNT_KIND')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EXTERNAL_ACCOUNT_KIND', function(Blueprint $table)
		{
			$table->dropForeign('fk_EXTERNAL_ACCOUNT_KIND_ACCOUNT_KIND1');
		});
	}

}
