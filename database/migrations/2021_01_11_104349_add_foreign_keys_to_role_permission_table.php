<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRolePermissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('role_permission', function(Blueprint $table)
		{
			$table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('role_id')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('role_permission', function(Blueprint $table)
		{
			$table->dropForeign('role_permission_permission_id_foreign');
			$table->dropForeign('role_permission_role_id_foreign');
		});
	}

}
