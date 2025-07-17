<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\Stop;

class StopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('stops_data.json');
        $stops_data = file_get_contents($file);
        $stops_data = json_decode($stops_data, true);
        $municipalities = \config('athens.trans');
        foreach($stops_data as $data)
        {
            //Find Municipality path
            foreach ($municipalities as $path => $municipality) {
                if($municipality === $data['dimos']){
                    $municipalityId = Municipality::query()->where('path_id', $path)->first()->id;
                    Stop::create([
                        'municipality_id' => $municipalityId,
                        'stop_code' => $data['stop_code'],
                        'stop_description' => $data['stop_descr'],
                        'stop_street' => $data['stop_street'],
                        'stoixeia_stasis' => $data['stoixeia_stasis'],
                        'stoptyp_code' => $data['stoptyp_code'],
                        'stop_url' => $data['stop_url'],
                    ]);
                }
            }
        }
    }
}
