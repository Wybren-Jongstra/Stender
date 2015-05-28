<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateINTERESTOPTIONTable2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('INTEREST_OPTION', function(Blueprint $table)
		{
			$table->integer('InterestOptionID', true);
			$table->integer('InterestKindID')->index('fk_INTEREST_OPTION_INTEREST_KIND1_idx');
			$table->string('Name', 100)->unique('Name_UNIQUE');
			$table->string('Description', 200)->unique('Description_UNIQUE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('INTEREST_OPTION');
	}

}
