<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesVisitedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cities_visited', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->primary(['user_id', 'city_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cities_visited');
	}

}
