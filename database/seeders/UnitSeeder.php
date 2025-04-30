<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $utama = Unit::create(['name' => 'Sekretariat Utama']);
        $utama->children()->createMany([
            ['name' => 'Biro Kepegawaian'],
            ['name' => 'Biro Keuangan'],
            ['name' => 'Biro Perencanaan'],
        ]);
        Unit::create(['name' => 'Pusat Data dan Informasi']);
    }
}
