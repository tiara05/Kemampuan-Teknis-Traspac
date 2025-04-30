<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Golongan;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golongans = ['I/a', 'II/b', 'III/a', 'III/b', 'IV/e'];
        foreach ($golongans as $g) {
            Golongan::create(['name' => $g]);
        }
    }
}
