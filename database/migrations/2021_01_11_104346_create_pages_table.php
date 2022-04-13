<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id')->unsigned()->nullable();
			$table->string('slug', 191)->nullable();
			$table->text('image', 65535)->nullable();
			$table->text('modules', 65535)->nullable();
			$table->boolean('status')->default(1);
			$table->boolean('pin')->default(0);
			$table->integer('views')->default(0);
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
		Schema::drop('pages');
	}

}
