<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHASHTAGKINDTable3 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('HASHTAG_KIND', function(Blueprint $table)
		{
			$table->integer('HashtagKindID', true);
			$table->string('Name', 20)->unique('Name_UNIQUE');
			$table->string('Description', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('HASHTAG_KIND');
	}

}
