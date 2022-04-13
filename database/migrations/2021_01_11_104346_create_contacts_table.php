<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('phone', 191)->nullable();
			$table->string('title', 191)->nullable();
			$table->string('address', 191)->nullable();
			$table->text('message', 65535)->nullable();
			$table->boolean('status')->default(0);
			$table->integer('id_number')->nullable();
			$table->string('nationality')->nullable();
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
		Schema::drop('contacts');
	}

}
