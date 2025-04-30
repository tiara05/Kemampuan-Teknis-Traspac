<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eselon;

class EselonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eselons = ['I.a', 'II.a', 'III.a', 'IV.a'];
        foreach ($eselons as $e) {
            Eselon::create(['name' => $e]);
        }
    }
}
