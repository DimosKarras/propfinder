<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criminality extends Model
{
    use HasFactory;

    protected $table = 'criminalities';
    protected $fillable = ['year', 'type', 'number_of_crimes'];

    public function calculateIndex($year)
    {
        $data = self::query()->where('year', 2019)->get();
        $crimes = 0;
        foreach ($data as $crime_data) {
            $crimes += $crime_data['number_of_crimes'];
        }

        if($crimes < 50000) {
            $finalIndex = 5.0;
        } else if ($crimes >= 50000 && $crimes < 59999) { // 5 - 4
            $finalIndex = 5 - (($crimes - 50000) / 9999);
        } else if ($crimes >= 60000 && $crimes < 69999) { // 4 - 3
            $finalIndex = 4 - (($crimes - 60000) / 9999);
        } else if ($crimes >= 70000 && $crimes < 79999) { // 3 - 2
            $finalIndex = 3 - (($crimes - 70000) / 9999);
        } else if ($crimes >= 80000 && $crimes < 89999) { // 2 - 1
            $finalIndex = 2 - (($crimes - 80000) / 9999);
        } else if ($crimes >= 90000 && $crimes < 100000) {
            $finalIndex = 1 - (($crimes - 90000) / 10000);
        } else $finalIndex = 0;

        return  number_format($finalIndex,2);
    }
}
