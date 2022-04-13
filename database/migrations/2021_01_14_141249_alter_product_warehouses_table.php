<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_warehouses',function(Blueprint $table){
            $table->unsignedInteger('stock_id')->after('price');
            $table->string('cost')->after('price');
            $table->string('date')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_warehouses',function(Blueprint $table){
            $table->dropColumn('stock_id')->after('price');
            $table->dropColumn('cost')->after('price');
        });
    }
}
