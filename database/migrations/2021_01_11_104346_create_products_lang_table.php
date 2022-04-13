<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('status')->default(1);
			$table->boolean('featured')->default(0);
			$table->integer('product_id')->unsigned()->index('products_lang_product_id_foreign');
			$table->string('lang', 191);
			$table->string('title', 191);
			$table->text('content')->nullable();
			$table->text('description', 16777215)->nullable();
			$table->text('keywords', 16777215)->nullable();
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
		Schema::drop('products_lang');
	}

}
