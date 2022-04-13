<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'status' => 1,
                'created_at' => '2018-08-30 00:00:00',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'status' => 1,
                'created_at' => '2018-10-02 11:04:49',
                'updated_at' => '2018-10-02 11:04:49',
            ),
            2 => 
            array (
                'id' => 3,
                'status' => 1,
                'created_at' => '2020-01-21 00:49:21',
                'updated_at' => '2020-01-21 00:49:21',
            ),
        ));
        
        
    }
}