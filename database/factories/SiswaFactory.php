<?php

namespace Database\Factories;

use Faker\Factory as faker;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        $faker = faker::create();
        $kelas = Arr::random(['X', 'XI', 'XII']);
        $jurusan = Arr::random(['DKV', 'KPR', 'TSM']);
        return [
            'nama_siswa' => $faker->name(),
            'id_kelas' => $faker->numberBetween(1, 3),
            'id_jurusan' => $faker->numberBetween(1, 3),
            'id_rombel' => $faker->numberBetween(1, 3),
            'username' => $faker->word(),
            'password' => $faker->numberBetween(1000, 9999),
        ];
    }
}
