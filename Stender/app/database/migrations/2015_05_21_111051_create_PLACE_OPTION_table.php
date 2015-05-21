<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePLACEOPTIONTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PLACE_OPTION', function(Blueprint $table)
		{
			$table->integer('PlaceOptionID', true);
			$table->integer('PlaceKindID')->index('fk_PLACE_PLACE_KIND1_idx');
			$table->dateTime('DateCreated');
			$table->dateTime('DateUpdated')->nullable();
			$table->string('Name', 200)->unique('Name_UNIQUE');
			$table->string('Description', 100);
			$table->string('StreetName', 50);
			$table->integer('HouseNumber');
			$table->string('HouseNumberSuffix', 6);
			$table->string('Zip', 7);
			$table->string('City', 30);
			$table->string('Country', 30);
			$table->string('PhoneNumer', 12)->nullable();
			$table->string('Email', 254)->nullable();
			$table->string('WebsiteUrl')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('PLACE_OPTION');
	}

}
