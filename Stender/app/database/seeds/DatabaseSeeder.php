<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('ACCOUNTKINDTableSeeder');
        $this->call('EXTERNALACCOUNTKINDTableSeeder');
        $this->call('CONNECTIONSTATUSTableSeeder');
        $this->call('EDUCATIONTableSeeder');
        $this->call('USERKINDTableSeeder');
		$this->call('USERTableSeeder');

	}

}
