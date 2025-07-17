<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\HeatingArea;

class HeatingAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('heating_data.json');
        $heating_data = file_get_contents($file);
        $heating_data = json_decode($heating_data, true);
        $municipalities = \config('athens.trans');
        foreach($heating_data as $data)
        {
            //Find Municipality path
            foreach ($municipalities as $path => $municipality) {
                if($municipality === $data['municipality']){
                    $municipalityId = Municipality::query()->where('path_id', $path)->first()->id;
                    HeatingArea::create([
                        'municipality_id' => $municipalityId,
                        'building' => $data['building'],
                        'address' => $data['address'],
                        'phone' => $data['phones'],
                        'time' => $data['time']
                    ]);
                }
            }
        }
    }
}
