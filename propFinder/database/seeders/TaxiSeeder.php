<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\Taxi;

class TaxiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('taxi_data.json');
        $taxi_data = file_get_contents($file);
        $taxi_data = json_decode($taxi_data, true);
        $municipalities = \config('athens.trans');
        foreach($taxi_data as $data)
        {
            //Find Municipality path
            foreach ($municipalities as $path => $municipality) {
                //dd([$municipality, $data['municipality']]);
                if($municipality === $data['dimos']){
                    $municipalityId = Municipality::query()->where('path_id', $path)->first()->id;
                }
            }

            Taxi::create([
                'municipality_id' => $municipalityId,
                'area' => $data['perioxi'],
                'name' => $data['name'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
            ]);
        }
    }
}
