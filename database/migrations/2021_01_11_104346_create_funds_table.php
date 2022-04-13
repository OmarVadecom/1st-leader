<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funds', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('price_id');
			$table->integer('client_id');
			$table->string('money', 100)->nullable();
			$table->date('date_from')->nullable();
			$table->date('date_to')->nullable();
			$table->integer('type')->nullable()->default(0);
			$table->string('bank', 100)->nullable();
			$table->string('bank_num', 200)->nullable();
			$table->text('note', 65535)->nullable();
			$table->integer('status')->default(0);
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
		Schema::drop('funds');
	}

}
