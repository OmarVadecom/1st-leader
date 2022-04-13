<?php

use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_permission')->delete();
        
        \DB::table('role_permission')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'permission_id' => 1,
                'created_at' => '2018-08-30 00:00:00',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 5,
                'role_id' => 1,
                'permission_id' => 5,
                'created_at' => '2018-08-30 00:00:00',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 19,
                'role_id' => 1,
                'permission_id' => 9,
                'created_at' => '2018-08-30 00:00:00',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 20,
                'role_id' => 1,
                'permission_id' => 10,
                'created_at' => '2018-09-02 00:00:00',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 21,
                'role_id' => 1,
                'permission_id' => 11,
                'created_at' => '2018-09-02 00:00:00',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 25,
                'role_id' => 1,
                'permission_id' => 15,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 29,
                'role_id' => 1,
                'permission_id' => 19,
                'created_at' => '2018-09-16 00:00:00',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 33,
                'role_id' => 1,
                'permission_id' => 23,
                'created_at' => '2018-09-16 00:00:00',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 34,
                'role_id' => 1,
                'permission_id' => 24,
                'created_at' => '2018-09-27 00:00:00',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 38,
                'role_id' => 1,
                'permission_id' => 28,
                'created_at' => '2018-09-30 00:00:00',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 42,
                'role_id' => 1,
                'permission_id' => 32,
                'created_at' => '2018-09-30 00:00:00',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 46,
                'role_id' => 2,
                'permission_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 51,
                'role_id' => 3,
                'permission_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 54,
                'role_id' => 3,
                'permission_id' => 32,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 56,
                'role_id' => 3,
                'permission_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}