<?php

namespace Database\Seeders;

use App\Models\Municipality;
use App\Models\Population;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('population.json');
        $population = file_get_contents($file);
        $population = json_decode($population, true);

        foreach($population['data'] as $year  => $values)
        {
            foreach ($values as $data) {
                $municipalityId = Municipality::query()->where('name', $data['municipality'])->first()->id;
                Population::create([
                    'municipality_id' => $municipalityId,
                    'year' => $year,
                    'men' => $data['men'],
                    'women' => $data['women']
                ]);
            }
        }
    }
}
