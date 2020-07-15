<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->timestamps();
			$table->increments('id');
			$table->string('name', 32);
			$table->integer('governorate_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}