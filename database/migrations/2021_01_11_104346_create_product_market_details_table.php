<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductMarketDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_market_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('product_id');
			$table->string('supplier');
			$table->string('date', 500);
			$table->string('sales_man');
			$table->string('phone');
			$table->string('price', 200);
			$table->string('employee');
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
		Schema::drop('product_market_details');
	}

}
