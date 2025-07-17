<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;

    protected $table = 'populations';
    protected $fillable = ['municipality_id', 'year', 'men', 'women'];

    public function calculateIndex($area): string
    {
        $density = ($this->men + $this->women)/$area;
        if($density < 1000) {
            $finalIndex = 5.0;
        } else if ($density >= 1000 && $density < 2500) { // 5 - 4
            $finalIndex = 5 - (($density - 1000) / 2500);
        } else if ($density >= 2500 && $density < 5000) { // 4 - 3
            $finalIndex = 4 - (($density - 2500) / 2500);
        } else if ($density >= 5000 && $density < 7500) { // 3 - 2
            $finalIndex = 3 - (($density - 5000) / 2500);
        } else if ($density >= 7500 && $density < 10000) { // 2 - 1
            $finalIndex = 2 - (($density - 7500) / 2500);
        } else if ($density >= 10000 && $density < 20000) {
            $finalIndex = 1 - (($density - 10000) / 10000);
        } else $finalIndex = 0;

        return  number_format($finalIndex,2);
    }

    public function municipality(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_id', 'id');
    }

}
