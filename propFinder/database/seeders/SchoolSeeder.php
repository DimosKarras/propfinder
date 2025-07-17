<?php

namespace Database\Seeders;

use App\Models\Municipality;
use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Flysystem\Config;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('schools_data.json');
        $schools = file_get_contents($file);
        $schools = json_decode($schools, true);

        $municipalities = \config('athens.trans');
        foreach ($schools as $school) {
            //Find Municipality path
            foreach ($municipalities as $path => $municipality) {
                if($municipality === $school['municipality']){
                    $municipalityId = Municipality::query()->where('path_id', $path)->first()->id;
                }
            }

            School::create([
                'municipality_id' => $municipalityId,
                'kind' => $school['kind'],
                'type' => $school['type'],
                'name' => $school['name'],
                'phone' => $school['phone'],
                'fax' => $school['fax'],
                'email' => $school['email'],
                'address' => $school['address'],
                'post_code' => $school['zip_code']
            ]);
        }
    }
}
