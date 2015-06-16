<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToREVIEWTable8 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('REVIEW', function(Blueprint $table)
		{
			$table->foreign('ForUserProfileID', 'fk_REVIEW_USER_PROFILE1')->references('UserProfileID')->on('USER_PROFILE')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('FromUserProfileID', 'fk_REVIEW_USER_PROFILE2')->references('UserProfileID')->on('USER_PROFILE')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign('fk_REVIEW_USER_PROFILE1');
			$table->dropForeign('fk_REVIEW_USER_PROFILE2');
		});
	}

}
