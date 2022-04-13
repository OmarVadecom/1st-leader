<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePriceOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('price_offers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('parent')->nullable();
			$table->integer('user_id');
			$table->integer('visit_id')->nullable();
			$table->integer('customer_id');
			$table->string('products_id');
			$table->string('parts_id')->nullable();
			$table->string('quantities');
			$table->string('prices');
			$table->string('discounts');
			$table->string('dreba')->nullable();
			$table->string('totals')->nullable();
			$table->integer('type')->nullable()->default(0);
			$table->integer('inv_type')->nullable()->default(1);
			$table->text('notes', 65535)->nullable();
			$table->string('time', 191);
			$table->string('date', 191);
			$table->string('offer_number', 191)->nullable();
			$table->string('offer_duration', 191);
			$table->text('declaration', 65535)->nullable();
			$table->text('offer_details', 65535)->nullable();
			$table->text('client_details', 65535)->nullable();
			$table->text('addon_notes', 65535)->nullable();
			$table->string('addon_discount', 300)->nullable();
			$table->integer('down_payment_perc')->nullable();
			$table->integer('down_payment')->nullable();
			$table->integer('prepare')->default(0);
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
		Schema::drop('price_offers');
	}

}
