<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitsMarketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visits_market', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('visit_id');
			$table->string('market_brand', 500);
			$table->string('market_type', 500);
			$table->string('market_model', 500);
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
		Schema::drop('visits_market');
	}

}
