<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->double('quantity');
			$table->string('patient_name', 32);
			$table->integer('blood_type_id')->unsigned();
			$table->decimal('latitude', 10,8);
			$table->decimal('longitude', 10,8);
			$table->string('address', 255);
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}