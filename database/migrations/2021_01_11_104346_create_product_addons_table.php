<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductAddonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_addons', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('product_id');
			$table->string('units')->nullable();
			$table->string('units_barcode')->nullable();
			$table->string('units_cons')->nullable();
			$table->string('unit_default', 11)->nullable();
			$table->string('prices')->nullable();
			$table->string('prices_discounts')->nullable();
			$table->string('prices_targets')->nullable();
			$table->string('gifts_ids')->nullable();
			$table->string('gifts_quantities')->nullable();
			$table->string('gifts_for')->nullable();
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
		Schema::drop('product_addons');
	}

}
