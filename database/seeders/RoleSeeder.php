<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'role_name' => 'admin',
                'description' => 'Administrator'
            ],
            [
                'role_name' => 'cashier_osm',
                'description' => 'Kasir_OSM'
            ],
            [
                'role_name' => 'cashier_kd',
                'description' => 'Kasir KD'
            ],
            [
                'role_name' => 'owner',
                'description' => 'Pemilik'
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
