<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('products_id')->nullable();
			$table->string('parts_id', 300)->nullable();
			$table->string('code')->nullable();
			$table->string('code_type', 50)->nullable();
			$table->string('type')->nullable();
			$table->string('insurance')->nullable();
			$table->string('name')->nullable();
			$table->string('name_en')->nullable();
			$table->string('image')->nullable();
			$table->integer('origin_id')->nullable();
			$table->integer('country_id')->nullable();
			$table->integer('brand_id')->nullable();
			$table->integer('color')->nullable();
			$table->integer('product_type')->nullable();
			$table->text('description', 65535)->nullable();
			$table->integer('quantity')->nullable()->default(0);
			$table->string('attachment_names', 500)->nullable();
			$table->text('attachments', 65535)->nullable();
			$table->string('specs_names', 500)->nullable();
			$table->string('specs_name', 500)->nullable();
			$table->text('specs_desc', 65535)->nullable();
			$table->string('charts_names', 500)->nullable();
			$table->text('charts_description', 65535)->nullable();
			$table->text('charts', 65535)->nullable();
			$table->string('related_ids')->nullable();
			$table->string('discount', 100)->nullable();
			$table->integer('discountquantity')->nullable();
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
		Schema::drop('parts');
	}

}
