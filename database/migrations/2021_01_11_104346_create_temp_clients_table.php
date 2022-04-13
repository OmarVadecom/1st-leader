<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTempClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('temp_clients', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('product_id');
			$table->string('code', 200)->nullable();
			$table->string('type', 150)->nullable();
			$table->integer('year')->nullable();
			$table->string('image', 150)->nullable();
			$table->string('bui_name', 150)->nullable();
			$table->string('segl_name', 150)->nullable();
			$table->string('center_name', 150)->nullable();
			$table->string('postal_code', 150)->nullable();
			$table->string('region', 150)->nullable();
			$table->string('city', 150)->nullable();
			$table->string('address', 400)->nullable();
			$table->string('maintainace_cat', 150)->nullable();
			$table->string('worker_num', 100)->nullable();
			$table->string('phone', 30)->nullable();
			$table->string('fax', 30)->nullable();
			$table->string('supervisor', 100)->nullable();
			$table->string('mobile', 30)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('password', 150)->nullable();
			$table->string('website', 100)->nullable();
			$table->string('lat', 150)->nullable();
			$table->string('lng', 150)->nullable();
			$table->string('old_bui', 100)->nullable();
			$table->string('old_segl_num', 100)->nullable();
			$table->string('old_center', 100)->nullable();
			$table->string('old_responsable', 100)->nullable();
			$table->string('old_mobile', 100)->nullable();
			$table->string('greeting', 100)->nullable();
			$table->string('title', 100)->nullable();
			$table->string('truecaller_id', 200)->nullable();
			$table->string('truecaller_pass', 150)->nullable();
			$table->string('anydesk_id', 150)->nullable();
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
		Schema::drop('temp_clients');
	}

}
