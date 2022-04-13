<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSponserToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('resp_name_sponsor')->nullable();
            $table->string('work_sponsor')->nullable();
            $table->string('resp_tele_sponsor')->nullable();
            $table->string('resp_phone_sponsor')->nullable();
            $table->string('resp_email_sponsor')->nullable();
            $table->string('resp_tele_red_sponsor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
}
