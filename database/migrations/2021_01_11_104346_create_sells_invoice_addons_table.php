<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellsInvoiceAddonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sells_invoice_addons', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('invoice_id');
			$table->string('title');
			$table->integer('cost');
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
		Schema::drop('sells_invoice_addons');
	}

}
