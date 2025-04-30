<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Golongan;
use App\Models\Eselon;
use App\Models\Unit;
use App\Models\Pegawai;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->numerify('##########'),
            'nama' => fake()->name(),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'golongan_id' => Golongan::inRandomOrder()->first()->id,
            'eselon_id' => Eselon::inRandomOrder()->first()->id,
            'jabatan' => fake()->jobTitle(),
            'unit_id' => Unit::inRandomOrder()->first()->id,
            'tempat_tugas' => fake()->city(),
            'agama' => fake()->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha']),
            'alamat' => fake()->address(),
            'no_hp' => fake()->phoneNumber(),
            'npwp' => fake()->numerify('##.###.###.#-###.###'),
            'foto' => null,
        ];
    }
}
