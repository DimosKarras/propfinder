<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\Metro;

class MetroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('metro_data.json');
        $metro_data = file_get_contents($file);
        $metro_data = json_decode($metro_data, true);
        $municipalities = \config('athens.trans');
        foreach($metro_data as $data)
        {
            //Find Municipality path
            foreach ($municipalities as $path => $municipality) {
                if($municipality === $data['municipality']){
                    $municipalityId = Municipality::query()->where('path_id', $path)->first()->id;
                    Metro::create([
                        'municipality_id' => $municipalityId,
                        'line' => $data['line'],
                        'name' => $data['name'],
                        'latitude' => $data['latitude'],
                        'longitude' => $data['longitude'],
                        'road' => $data['road']
                    ]);
                }
            }
        }
    }
}
