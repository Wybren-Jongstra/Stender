<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHASHTAGOPTIONTable3 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('HASHTAG_OPTION', function(Blueprint $table)
		{
			$table->integer('HashtagOptionID', true);
			$table->integer('HashTagKindID')->index('fk_HASHTAG_HASHTAG_KIND1_idx');
			$table->string('Name', 100)->unique('Name_UNIQUE');
			$table->string('Description', 200);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('HASHTAG_OPTION');
	}

}
