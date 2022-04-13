<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartsProductsOutTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parts_products_out', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('part_id');
			$table->string('code', 100)->nullable();
			$table->string('company', 100)->nullable();
			$table->string('wakel', 100)->nullable();
			$table->string('image', 100)->nullable();
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
		Schema::drop('parts_products_out');
	}

}
