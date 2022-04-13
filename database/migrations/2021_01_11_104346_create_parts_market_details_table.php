<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartsMarketDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parts_market_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('part_id');
			$table->string('supplier')->nullable();
			$table->string('date', 500)->nullable();
			$table->string('sales_man')->nullable();
			$table->string('phone')->nullable();
			$table->string('price', 200)->nullable();
			$table->string('employee')->nullable();
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
		Schema::drop('parts_market_details');
	}

}
