<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateREVIEWTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('REVIEW', function(Blueprint $table)
		{
			$table->integer('ReviewID', true);
			$table->integer('ForUserID')->index('fk_REVIEW_USER1_idx');
			$table->integer('FromUserID')->index('fk_REVIEW_USER2_idx');
			$table->dateTime('DateCreated');
			$table->dateTime('DateUpdated')->nullable();
			$table->boolean('Deleted');
			$table->string('Description', 510);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('REVIEW');
	}

}
