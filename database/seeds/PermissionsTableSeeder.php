<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     * @return void
     */
    public function run()
    {
        $permissions = [];

        // Users
        $permissions[] = [
            'create'    => 'users', // ID => 1
            'edit'      => 'users', // ID => 2
            'show'      => 'users', // ID => 3
            'view'      => 'users', // ID => 4
        ];

        // Visits
        $permissions[] = [
            'show_preparing_orders'     => 'visits', // ID => 5
            'show_delivery_orders'      => 'visits', // ID => 6
            'preparing_orders'          => 'visits', // ID => 7
            'available_report'          => 'visits', // ID => 8
            'delivery_orders'           => 'visits', // ID => 9
            'booked_report'             => 'visits', // ID => 10
            'reports_sells'             => 'visits', // ID => 11
            'sells_of_day'              => 'visits', // ID => 12
            'sold_report'               => 'visits', // ID => 13
            'buy_report'                => 'visits', // ID => 14
            'map_visits'                => 'visits', // ID => 15
            'create'                    => 'visits', // ID => 16
            'edit'                      => 'visits', // ID => 17
            'show'                      => 'visits', // ID => 18
            'view'                      => 'visits', // ID => 19
        ];

        // PriceOffers
        $permissions[] = [
            'index_verify'  => 'Price_offers', // ID => 20
            'create'        => 'Price_offers', // ID => 21
            'edit'          => 'Price_offers', // ID => 22
            'show'          => 'Price_offers', // ID => 23
            'view'          => 'Price_offers', // ID => 24
        ];

        // Preparation
        $permissions[] = [
            'create'    => 'preparation', // ID => 25
            'edit'      => 'preparation', // ID => 26
            'show'      => 'preparation', // ID => 27
            'view'      => 'preparation', // ID => 28
        ];

        // Delivery
        $permissions[] = [
            'create'    => 'delivery', // ID => 29
            'edit'      => 'delivery', // ID => 30
            'show'      => 'delivery', // ID => 31
            'view'      => 'delivery', // ID => 32
        ];

        $permissionsStoringInDB = [];

        foreach($permissions as $key => $model) {
            $permissionsStoringInDB[] = [
                'created_at'    => now(),
                'updated_at'    => now(),
                'status'        => 1,
                'name'          => $key,
                'for'           => $model
            ];
        }

        DB::table('permissions')->delete();
        DB::table('permissions')->insert($permissionsStoringInDB);
    }
}
