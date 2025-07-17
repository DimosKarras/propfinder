<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\CoolingArea;

class CoolingAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('cooling_data.json');
        $cooling_data = file_get_contents($file);
        $cooling_data = json_decode($cooling_data, true);
        $municipalities = \config('athens.trans');
        $final = [];
        $other = [];
        foreach($cooling_data as $data)
        {
            //Find Municipality path
            foreach ($municipalities as $path => $municipality) {
                if($municipality === $data['municipality']){
                    $final[] = $data['municipality'];
                    $municipalityId = Municipality::query()->where('path_id', $path)->first()->id;
                    CoolingArea::create([
                        'municipality_id' => $municipalityId,
                        'building' => $data['building'],
                        'address' => $data['address'],
                        'phone' => $data['phone'],
                        'time' => $data['time']
                    ]);
                } else {
                    if(!in_array($data['municipality'], $municipalities) && !in_array($data['municipality'], $other)){
                        $other[] = $data['municipality'];  
                    }
                }
            }
        }
        $collection = collect($final);
            dump($collection->sort());
            dump(count($final));
            dump($other);
    }
}
