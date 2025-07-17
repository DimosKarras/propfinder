<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\KdapDisability;

class KdapDisabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('kdap_amea_data.json');
        $kdap_data = file_get_contents($file);
        $kdap_data = json_decode($kdap_data, true);
        $municipalities = \config('athens.trans');
        $final = [];
        $other = [];
        foreach($kdap_data as $data)
        {
            //Find Municipality path
            foreach ($municipalities as $path => $municipality) {
                if($municipality === $data['municipality']){
                    $final[] = $data['municipality'];
                    $municipalityId = Municipality::query()->where('path_id', $path)->first()->id;
                    KdapDisability::create([
                        'municipality_id' => $municipalityId,
                        'name' => $data['name'],
                        'address' => $data['address'],
                        'email' => $data['email'],
                        'site' => $data['site'],
                        'phone' => $data['phone'],
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
