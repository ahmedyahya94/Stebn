<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bikes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('type');
            $table->string('vendor');
            $table->text('features');
            $table->date('date_of_purchase');
            $table->integer('model');
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
		Schema::drop('bikes');
	}

}
