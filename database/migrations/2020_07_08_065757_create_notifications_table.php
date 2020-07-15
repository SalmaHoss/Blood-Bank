<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 32);
			$table->string('body');
			$table->integer('donation_request_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}