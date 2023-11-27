<?php

namespace Database\Seeders;

use App\Models\JenisUjian;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisUjian::factory()->count(4)->create();
    }
}
