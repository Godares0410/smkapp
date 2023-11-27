<?php

namespace Database\Factories;

use App\Models\JenisUjian;
use Faker\Factory as faker;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mapel>
 */
class JenisUjianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = JenisUjian::class;
    public function definition()
    {
        // $kelas = ['X', 'XI', 'XII'];
        // $faker = faker::create();
        static $jenisUjian = ['UTS GASAL', 'PAS', 'UTS GENAP', 'PAT'];
        return [
            'nama_ujian' => array_shift($jenisUjian)
        ];
    }
}
