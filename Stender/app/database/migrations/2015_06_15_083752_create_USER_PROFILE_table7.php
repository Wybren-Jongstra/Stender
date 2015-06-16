<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUSERPROFILETable7 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('USER_PROFILE', function(Blueprint $table)
		{
			$table->integer('UserProfileID', true);
			$table->dateTime('DateUpdated')->nullable();
			$table->string('ProfileUrlPart')->unique('ProfileURL_UNIQUE');
			$table->string('DisplayName', 151);
			$table->string('PhotoUrl')->nullable();
			$table->string('FirstName', 75);
			$table->string('Surname', 75);
			$table->string('Prefix', 50)->nullable();
			$table->string('MiddleName', 800)->nullable();
			$table->string('SurnamePrefix', 20)->nullable();
			$table->string('Suffix', 45)->nullable();
			$table->date('Birthday')->nullable();
			$table->integer('GenderID')->nullable()->index('fk_USER_DATA_GENDER1_idx');
			$table->integer('SexualOrientationID')->nullable()->index('fk_USER_PROFILE_SEXUAL_ORIENTATION1_idx');
			$table->string('StreetName', 50)->nullable();
			$table->integer('HouseNumber')->nullable();
			$table->string('HouseNumberSuffix', 6)->nullable();
			$table->string('Zip', 7)->nullable();
			$table->string('City', 30)->nullable();
			$table->string('Country', 30)->nullable();
			$table->string('AlternativeEmail', 254)->nullable();
			$table->integer('EducationID')->nullable()->index('fk_USER_PROFILE_EDUCATION1_idx');
			$table->string('Description')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('USER_PROFILE');
	}

}
