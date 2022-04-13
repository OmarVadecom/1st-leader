<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitsDelegateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visits_delegate', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('visit_id');
			$table->integer('delegatestars')->nullable();
			$table->integer('delegateclient')->nullable();
			$table->integer('con_way')->nullable();
			$table->text('del_notes', 65535)->nullable();
			$table->string('del_visit')->nullable();
			$table->text('del_visit_reason', 65535)->nullable();
			$table->integer('managervisit')->nullable();
			$table->integer('managerdelegate')->nullable();
			$table->text('sales_notes', 65535)->nullable();
			$table->text('sales_recommend', 65535)->nullable();
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
		Schema::drop('visits_delegate');
	}

}
