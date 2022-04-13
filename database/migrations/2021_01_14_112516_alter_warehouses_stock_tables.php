<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterWarehousesStockTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse',function(Blueprint $table){
            $table->unsignedInteger('stock_id')->after('name');
        });


        Schema::table('stock',function(Blueprint $table){
            $table->dropColumn('warehouse_id');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse',function(Blueprint $table){
            $table->dropColumn('stock_id');
        });


        Schema::table('stock',function(Blueprint $table){
            $table->unsignedInteger('warehouse_id');
        });
    }
}
