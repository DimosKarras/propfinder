<?php

namespace Database\Seeders;

use App\Models\Municipality;
use App\Models\Population;
use App\Models\RealEstate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RealEstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('real_estate.json');
        $realEstate = file_get_contents($file);
        $realEstate = json_decode($realEstate, true);

        foreach($realEstate['data'] as $municipality  => $values)
        {
            $municipalityId = Municipality::query()->where('name', $municipality)->first()->id;
            foreach ($values as $value) {
                RealEstate::create([
                    'municipality_id' => $municipalityId,
                    'year' => $value['year'],
                    'apartment_price' => $value['price']
                ]);
            }
        }
    }
}
