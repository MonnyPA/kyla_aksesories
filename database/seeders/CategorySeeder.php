<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'cat_name' => 'Jeday',
                'description' => 'Kategori Jepiran Rambut (Jeday)'
            ],
            [
                'cat_name' => 'Boneka',
                'description' => 'Kategori Boneka'
            ],
            [
                'cat_name' => 'Mainan',
                'description' => 'Mainan Anak-anak'
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}
