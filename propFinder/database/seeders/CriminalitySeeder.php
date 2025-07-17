<?php

namespace Database\Seeders;

use App\Models\Criminality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriminalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('criminality_data.json');
        $criminality = file_get_contents($file);
        $criminality = json_decode($criminality, true);

        foreach ($criminality as $values){
            foreach ($values as $type => $years){
                foreach ($years as $year => $number) {
                    Criminality::create([
                        'type' => $type,
                        'year' => $year,
                        'number_of_crimes' => $number
                    ]);
                }
            }
        }
    }
}
