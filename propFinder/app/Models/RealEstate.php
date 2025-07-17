<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    use HasFactory;
    protected $table = 'real_estates';
    protected $fillable = ['municipality_id', 'price', 'year'];

    public function calculateIndex(): string
    {
        $price = $this->apartment_price;
        if($price < 1000) {
            $finalIndex = 5.0;
        } else if ($price >= 1000 && $price < 2000) { // 5 - 4
            $finalIndex = 5 - ($price - 1000) / 1000;
        } else if ($price >= 2000 && $price < 3000) { // 4 - 3
            $finalIndex = 4 - ($price - 2000) / 1000;
        } else if ($price >= 3000 && $price < 4000) { // 3 - 2
            $finalIndex = 3 - ($price - 3000) / 1000;
        } else if ($price >= 4000 && $price < 5000) { // 2 - 1
            $finalIndex = 2 - ($price - 4000) / 1000;
        } else if ($price >= 5000) {
            $finalIndex = 1.0;
        }

        return  number_format($finalIndex,2);
    }

    public function municipality(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_id', 'id');
    }
}

