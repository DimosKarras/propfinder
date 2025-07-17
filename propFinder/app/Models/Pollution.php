<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pollution extends Model
{
    use HasFactory;

    protected $table = 'pollutions';
    protected $fillable = ['municipality_id', 'date', 'pollutant', 'value'];
    protected $cast = [
        'date' => 'datetime:d-m-Y'
    ];

    public function calculateIndex($municipalityId): ?float
    {
        $validMunicipalies = self::query()->distinct()->pluck('municipality_id');
        if(!in_array($municipalityId, $validMunicipalies->toArray())){
            return null;
        }

        $o3Mean = self::query()
            ->where('municipality_id', $municipalityId)
            ->whereBetween('date', ["2022-01-01", "2022-12-31"])
            ->where('pollutant', 'O3')
            ->whereNotNull('value')
            ->avg('value');

        $no2Mean = self::query()
            ->where('municipality_id', $municipalityId)
            ->whereBetween('date', ["2022-01-01", "2022-12-31"])
            ->where('pollutant', 'NO2')
            ->whereNotNull('value')
            ->avg('value');

        $finalArray = [
            'O3' => round($o3Mean, 2),
            'NO2' => round($no2Mean, 2),
        ];


        if ($finalArray['O3'] >= 0 && $finalArray['O3'] < 50) { // 5 - 4
            $finalIndex['O3'] = 5 - (($finalArray['O3'] - 0) / 49);
        } else if ($finalArray['O3'] >= 51 && $finalArray['O3'] < 100) { // 4 - 3
            $finalIndex['O3'] = 4 - (($finalArray['O3'] - 51) / 48);
        } else if ($finalArray['O3'] >= 101 && $finalArray['O3'] < 130) { // 3 - 2
            $finalIndex['O3'] = 3 - (($finalArray['O3'] - 101) / 28);
        } else if ($finalArray['O3'] >= 131 && $finalArray['O3'] < 240) { // 2 - 1
            $finalIndex['O3'] = 2 - (($finalArray['O3'] - 131) / 108);
        } else if ($finalArray['O3'] >= 241 && $finalArray['O3'] < 380) {
            $finalIndex['O3'] = 1 - (($finalArray['O3'] - 241) / 138);
        } else $finalIndex['O3'] = 0.01;

        if ($finalArray['NO2'] >= 0 && $finalArray['NO2'] < 40) { // 5 - 4
            $finalIndex['NO2'] = 5 - (($finalArray['NO2'] - 0) / 39);
        } else if ($finalArray['NO2'] >= 41 && $finalArray['NO2'] < 90) { // 4 - 3
            $finalIndex['NO2'] = 4 - (($finalArray['NO2'] - 41) / 48);
        } else if ($finalArray['NO2'] >= 91 && $finalArray['NO2'] < 120) { // 3 - 2
            $finalIndex['NO2'] = 3 - (($finalArray['NO2'] - 91) / 28);
        } else if ($finalArray['NO2'] >= 121 && $finalArray['NO2'] < 230) { // 2 - 1
            $finalIndex['NO2'] = 2 - (($finalArray['NO2'] - 121) / 108);
        } else if ($finalArray['NO2'] >= 231 && $finalArray['NO2'] < 340) {
            $finalIndex['NO2'] = 1 - (($finalArray['NO2'] - 231) / 108);
        } else $finalIndex['NO2'] = 0.01;

        //$finalIndex['Final'] = 0.5 * $finalIndex['O3'] + 0.5*$finalIndex['NO2'];
        return round((0.5 * $finalIndex['O3'] + 0.5*$finalIndex['NO2']), 2);
    }

}
