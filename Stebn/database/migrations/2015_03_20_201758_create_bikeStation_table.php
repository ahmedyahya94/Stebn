<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBikeStationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bikeStation', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('BatchSize');
            $table->string('location');
            $table->integer('maxCapacity');
            $table->boolean('functional');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bikeStation');
	}

}
