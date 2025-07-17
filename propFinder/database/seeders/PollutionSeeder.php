<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\Pollution;

class PollutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('pollution/smy/PM10#SMY.json');
        $pollution = file_get_contents($file);
        $pollution = json_decode($pollution, true);

        //dd($pollution);
        $municipality = Municipality::query()->where('path_id', 'path5602')->first();
        foreach ($pollution as $date => $value){
            Pollution::create([
                'municipality_id' => $municipality->id,
                'date' => date('Y-m-d', strtotime($date)),
                'pollutant' => 'PM10',
                'value' => $value
            ]);
        }
    }
}
