<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sells', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('inv_id')->nullable();
			$table->integer('product_id');
			$table->integer('client_id')->nullable();
			$table->integer('quantity');
			$table->integer('price');
			$table->string('insurance')->nullable();
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
		Schema::drop('sells');
	}

}
