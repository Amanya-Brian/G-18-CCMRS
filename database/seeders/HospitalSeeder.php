<?php

namespace Database\Seeders;
use App\Models\Hospitals;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hospital::factory()->count(155)->create();
    }
}
