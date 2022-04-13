<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable();
			$table->string('name_en')->nullable();
			$table->string('org_name')->nullable();
			$table->string('org_number')->nullable();
			$table->string('segl_number')->nullable();
			$table->string('dreb_number')->nullable();
			$table->string('lic_number')->nullable();
			$table->text('files', 65535)->nullable();
			$table->string('resp_name')->nullable();
			$table->string('resp_tele')->nullable();
			$table->string('resp_tele_red')->nullable();
			$table->string('resp_phone')->nullable();
			$table->string('resp_email')->nullable();
			$table->string('work')->nullable();
			$table->string('phonenumber')->nullable();
			$table->string('phonenumbertwo')->nullable();
			$table->string('fax')->nullable();
			$table->string('country')->nullable();
			$table->string('city')->nullable();
			$table->string('region')->nullable();
			$table->string('street')->nullable();
			$table->string('locate')->nullable();
			$table->string('email_add')->nullable();
			$table->string('telephone')->nullable();
			$table->string('telephone_red')->nullable();
			$table->string('googlemap')->nullable();
			$table->string('map_img')->nullable();
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
		Schema::drop('customers');
	}

}
