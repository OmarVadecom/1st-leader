<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellsInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sells_invoice', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('price_id');
			$table->string('cost');
			$table->integer('offer_price');
			$table->integer('remains');
			$table->text('notes', 65535)->nullable();
			$table->integer('total_bands')->nullable();
			$table->integer('total');
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
		Schema::drop('sells_invoice');
	}

}
