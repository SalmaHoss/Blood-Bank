<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone', 50);
			$table->string('name', 50);
			$table->string('email', 50)->nullable();
			$table->text('password', 32);
			$table->integer('pin_code')->nullable();
			$table->string('date_of_birth', 12);
			$table->integer('city_id')->unsigned();
			//$table->integer('client_post_id')->unsigned();
			$table->integer('blood_type_id')->unsigned();
		  //$table->integer('client_notifications_id')->unsigned();
			$table->string('api_token',60)->unique()->nullable();

		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
