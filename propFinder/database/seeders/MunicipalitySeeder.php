<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('municipalities.json');
        $municipalities = file_get_contents($file);
        $municipalities = json_decode($municipalities, true);
        foreach ($municipalities['data'] as $data) {
            Municipality::create([
                'name' => $data['municipality'],
                'sector' => $data['sector'],
                'density' => $data['area']
            ]);
        }
    }
}
