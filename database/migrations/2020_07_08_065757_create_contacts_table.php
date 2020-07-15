<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 50);
			$table->text('message');
			$table->string('phone');
			$table->string('name');
			$table->string('api_token',60)->unique()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}
