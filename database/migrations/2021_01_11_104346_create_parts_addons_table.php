<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartsAddonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parts_addons', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('part_id');
			$table->string('units')->nullable();
			$table->string('units_barcode')->nullable();
			$table->string('units_cons')->nullable();
			$table->string('unit_default', 11)->nullable();
			$table->string('prices')->nullable();
			$table->string('prices_discounts')->nullable();
			$table->string('prices_targets')->nullable();
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
		Schema::drop('parts_addons');
	}

}
