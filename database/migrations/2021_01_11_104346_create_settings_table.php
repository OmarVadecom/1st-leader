<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('slug', 191);
			$table->text('value', 65535)->nullable();
			$table->string('type', 191)->default('text');
			$table->string('lang', 191);
			$table->boolean('isOption')->default(0);
			$table->text('options', 65535)->nullable();
			$table->integer('sort_number')->default(0);
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
		Schema::drop('settings');
	}

}
