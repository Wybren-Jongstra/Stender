<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHASHTAGTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('HASHTAG', function(Blueprint $table)
		{
			$table->foreign('HashTagKindID', 'fk_HASHTAG_HASHTAG_KIND1')->references('HashtagKindID')->on('HASHTAG_KIND')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('HASHTAG', function(Blueprint $table)
		{
			$table->dropForeign('fk_HASHTAG_HASHTAG_KIND1');
		});
	}

}
