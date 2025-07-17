<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\TransitLine;

class TransitLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('dromologia.json');
        $dromologia = file_get_contents($file);
        $dromologia = json_decode($dromologia, true);
        $municipalities = \config('athens.trans');
        foreach($dromologia as $data)
        {
            //Find Municipality path
            foreach ($municipalities as $path => $municipality) {
                //dd([$municipality, $data['municipality']]);
                if($municipality === $data['municipality']){
                    $municipalityId = Municipality::query()->where('path_id', $path)->first()->id;
                    TransitLine::create([
                        'municipality_id' => $municipalityId,
                        'municipality_code' => $data['municipality_code'],
                        'transit_lines' => $data['transit_lines'],
                    ]);
                }
            }
        }
    }
}
