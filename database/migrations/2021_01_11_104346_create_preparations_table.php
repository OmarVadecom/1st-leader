<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePreparationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preparations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->time('time');
			$table->integer('customer_id')->unsigned();
			$table->integer('price_id')->unsigned()->nullable()->default(0);
			$table->date('date');
			$table->string('representative_name')->nullable();
			$table->string('representative_phone_number')->nullable();
			$table->string('preparator_name')->nullable();
			$table->string('type')->nullable();
			$table->string('status')->nullable();
			$table->string('progress')->nullable();
			$table->text('preparation_notes', 65535)->nullable();
			$table->string('deliverer_name')->nullable();
			$table->string('deliverer_phone_number')->nullable();
			$table->string('delivery_type')->nullable();
			$table->text('delivery_notes', 65535)->nullable();
			$table->string('recipient_name')->nullable();
			$table->string('reciept_city')->nullable();
			$table->string('reciept_region')->nullable();
			$table->string('reciept_street')->nullable();
			$table->string('recipient_phone_number')->nullable();
			$table->string('reciept_notes')->nullable();
			$table->string('reciept_lat')->nullable();
			$table->string('reciept_lng')->nullable();
			$table->text('notes', 65535)->nullable();
			$table->text('declaration', 65535)->nullable();
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
		Schema::drop('preparations');
	}

}
