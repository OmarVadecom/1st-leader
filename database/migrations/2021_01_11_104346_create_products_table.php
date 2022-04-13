<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('slug', 191)->nullable();
			$table->integer('product_category_id')->unsigned()->nullable()->index('parent_id');
			$table->text('image', 65535)->nullable();
			$table->boolean('status')->default(1);
			$table->boolean('featured')->default(0);
			$table->integer('views')->default(0);
			$table->integer('quantity')->default(0);
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
		Schema::drop('products');
	}

}
