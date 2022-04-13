<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitsClientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visits_client', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('visit_id');
			$table->string('mainrate', 20)->nullable();
			$table->integer('segl_type')->nullable();
			$table->integer('client_type')->nullable();
			$table->string('resp_name', 100)->nullable();
			$table->string('client_phone', 100)->nullable();
			$table->string('client_decision', 20)->nullable();
			$table->string('client_serious', 20)->nullable();
			$table->string('client_ready', 20)->nullable();
			$table->string('client_con', 20)->nullable();
			$table->string('client_clients')->nullable();
			$table->string('client_ins', 20)->nullable();
			$table->string('locationrate', 20)->nullable();
			$table->string('location_type', 20)->nullable();
			$table->string('services', 20)->nullable();
			$table->string('location_status', 20)->nullable();
			$table->string('client_location_status', 20)->nullable();
			$table->string('goods_available', 20)->nullable();
			$table->string('cleaning', 20)->nullable();
			$table->string('equip_interest', 20)->nullable();
			$table->string('distance', 20)->nullable();
			$table->string('workrate', 20)->nullable();
			$table->string('work_num', 20)->nullable();
			$table->string('nationality', 20)->nullable();
			$table->string('worker_rate', 20)->nullable();
			$table->string('worker_qualify', 20)->nullable();
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
		Schema::drop('visits_client');
	}

}
