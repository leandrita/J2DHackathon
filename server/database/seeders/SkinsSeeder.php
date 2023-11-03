<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkinsSeeder extends Seeder
{
    public function run(): void
    {
        $skins = [
            [
                'name' => 'Thor',
                'type' => 'Strength',
                'price' => '50 euros',
                'color' => 'red',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Loki',
                'type' => 'Intelligence',
                'price' => '150 euros',
                'color' => 'green',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ironman',
                'type' => 'Perfection',
                'price' => '550 euros',
                'color' => 'silver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hulk',
                'type' => 'Strength',
                'price' => '100 euros',
                'color' => 'green',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Captain America',
                'type' => 'Intelligence',
                'price' => '350 euros',
                'color' => 'blue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('skins')->insert($skins);
    }
}
