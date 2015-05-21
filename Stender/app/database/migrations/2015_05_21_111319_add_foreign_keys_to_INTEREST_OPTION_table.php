<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToINTERESTOPTIONTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('INTEREST_OPTION', function(Blueprint $table)
		{
			$table->foreign('InterestKindID', 'fk_INTEREST_OPTION_INTEREST_KIND1')->references('InterestKindID')->on('INTEREST_KIND')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('INTEREST_OPTION', function(Blueprint $table)
		{
			$table->dropForeign('fk_INTEREST_OPTION_INTEREST_KIND1');
		});
	}

}
