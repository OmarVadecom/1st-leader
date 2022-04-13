<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'username' => 'vadecom',
                'email' => 'admin@vadecom.net',
                'role_id' => 1,
                'isAdmin' => 1,
                'type' => 0,
                'password' => '$2y$12$MPZJrUMmqJNG0VXktAYyL.ohTm/ZDD8hWC0QXCFdqJ6w7EA13DRBa',
                'remember_token' => 'bMpOYtylsckLvDpaPCw6mWeL2pphw4UxOrISiTOgEZ2PgLrgKnNsJiKa3EeR',
                'created_at' => '2018-08-27 14:21:23',
                'updated_at' => '2018-10-07 13:33:35',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'محمد باهبري',
                'username' => NULL,
                'email' => 'm-bahabri@1st-leader.com',
                'role_id' => 0,
                'isAdmin' => 0,
                'type' => 0,
                'password' => '$2y$10$xB34Sk9XPMOINsF0xIMFaOr3SzjC9shWpxO96dM0Msi3ERHRSOmpy',
                'remember_token' => NULL,
                'created_at' => '2020-01-21 01:10:06',
                'updated_at' => '2020-01-21 01:13:33',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'test vadecom',
                'username' => NULL,
                'email' => 'test@test.com',
                'role_id' => 3,
                'isAdmin' => 1,
                'type' => 1,
                'password' => '$2y$10$Y3XoFWGkAT0c6hNuowhrGeP3CQ/nemccFn0bja6FZnt960F5hL/be',
                'remember_token' => '0toKuyhUYLDg0f1cXNTdGh6LkXYiTNjEFfqmuJmi7AVZKvyyTAqicUrZUy3Y',
                'created_at' => '2020-02-02 19:39:24',
                'updated_at' => '2020-02-02 19:39:24',
            ),
        ));
        
        
    }
}