<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchaseInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_invoice', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable();
			$table->string('company')->nullable();
			$table->string('serial_num', 500)->nullable();
			$table->string('products_id')->nullable();
			$table->string('quantities')->nullable();
			$table->string('prices')->nullable();
			$table->string('total')->nullable();
			$table->string('images')->nullable();
			$table->text('details', 65535)->nullable();
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
		Schema::drop('purchase_invoice');
	}

}
