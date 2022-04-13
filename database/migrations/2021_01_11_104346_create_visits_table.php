<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visits', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('customer_id');
			$table->integer('type')->nullable()->default(1);
			$table->string('products_in')->nullable();
			$table->string('quantities_in')->nullable();
			$table->string('products_out')->nullable();
			$table->string('quantities_out');
			$table->integer('status')->nullable()->default(0);
			$table->string('card_image')->nullable();
			$table->text('notes', 65535)->nullable();
			$table->string('inform')->nullable();
			$table->string('lat')->nullable();
			$table->string('lng')->nullable();
			$table->date('date')->nullable();
			$table->string('hour', 100)->nullable();
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
		Schema::drop('visits');
	}

}
