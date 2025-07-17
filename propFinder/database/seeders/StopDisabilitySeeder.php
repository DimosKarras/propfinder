<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\StopDisability;

class StopDisabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // ['municipality_id', 'stop_code', 'stop_name', 'stop_street', 'latitude', 'longitude', 'stop_url'];
    public function run(): void
    {
        $file = public_path('stops_amea_data.json');
        $stops_data = file_get_contents($file);
        $stops_data = json_decode($stops_data, true);
        $municipalities = \config('athens.trans');
        foreach($stops_data as $data)
        {
            //Find Municipality path
            foreach ($municipalities as $path => $municipality) {
                if($municipality === $data['municipality']){
                    $municipalityId = Municipality::query()->where('path_id', $path)->first()->id;
                    StopDisability::create([
                        'municipality_id' => $municipalityId,
                        'stop_code' => $data['stop_code'],
                        'stop_name' => $data['stop_name'],
                        'stop_street' => $data['stop_street'],
                        'latitude' => $data['latitude'],
                        'longitude' => $data['longitude'],
                        'stop_url' => $data['stop_url'],
                    ]);
                }
            }
        }
    }
}
