<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $usa = \App\Models\Country::firstOrCreate(['id' => 1, 'name' => 'USA']);
        $colombia = \App\Models\Country::firstOrCreate(['id' => 2, 'name' => 'Colombia']);
        
        $arizona = \App\Models\State::firstOrCreate(['id' => 1, 'country_id' => $usa->id, 'name' => 'Arizona']);
        $alabama = \App\Models\State::firstOrCreate(['id' => 2, 'country_id' => $usa->id, 'name' => 'Alabama']);
        $bogota = \App\Models\State::firstOrCreate(['id' => 3, 'country_id' => $colombia->id, 'name' => 'Bogotá']);
        $leticia = \App\Models\State::firstOrCreate(['id' => 4, 'country_id' => $colombia->id, 'name' => 'Leticia']);
        
        $phoenix = \App\Models\City::firstOrCreate(['id' => 1, 'state_id' => $arizona->id, 'name' => 'Phoenix']);
        $huntsville = \App\Models\City::firstOrCreate(['id' => 2, 'state_id' => $alabama->id, 'name' => 'Huntsville']);
        $capitalDistric = \App\Models\City::firstOrCreate(['id' => 3, 'state_id' => $bogota->id, 'name' => 'Capital District']);
        $amazonas = \App\Models\City::firstOrCreate(['id' => 4, 'state_id' => $leticia->id, 'name' => 'Amazonas']);

        \App\Models\User::factory(50)->create();
    }
}
