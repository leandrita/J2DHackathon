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
                'image' => 'algo',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Loki',
                'type' => 'Intelligence',
                'price' => '150 euros',
                'color' => 'green',
                'image' => 'algo',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('skins')->insert($skins);
    }
}
