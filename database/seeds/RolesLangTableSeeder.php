<?php

use Illuminate\Database\Seeder;

class RolesLangTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles_lang')->delete();
        
        \DB::table('roles_lang')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'lang' => 'ar',
                'name' => 'المدير',
                'comment' => 'يملك كل صلاحيات الموقع',
                'created_at' => '2018-08-30 00:00:00',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 1,
                'lang' => 'en',
                'name' => 'Admin',
                'comment' => 'has all permissions',
                'created_at' => '2018-08-30 00:00:00',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'role_id' => 2,
                'lang' => 'ar',
                'name' => 'كاتب',
                'comment' => NULL,
                'created_at' => '2018-10-02 11:04:49',
                'updated_at' => '2018-10-02 11:04:49',
            ),
            3 => 
            array (
                'id' => 4,
                'role_id' => 2,
                'lang' => 'en',
                'name' => 'Writer',
                'comment' => NULL,
                'created_at' => '2018-10-02 11:04:49',
                'updated_at' => '2018-10-02 11:04:49',
            ),
            4 => 
            array (
                'id' => 5,
                'role_id' => 3,
                'lang' => 'ar',
                'name' => 'المستودع',
                'comment' => NULL,
                'created_at' => '2020-01-21 00:49:21',
                'updated_at' => '2020-01-21 00:49:21',
            ),
        ));
        
        
    }
}