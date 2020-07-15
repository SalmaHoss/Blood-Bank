<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('fb_url')->nullable();
			$table->string('insta_url')->nullable();
	
			$table->string('app_store_url')->nullable();
			$table->string('phone');
			$table->string('play_store_url');
			$table->text('about_app');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
