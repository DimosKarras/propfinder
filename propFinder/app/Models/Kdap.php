<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kdap extends Model
{
    use HasFactory;
    protected $table = 'kdaps';
    protected $fillable = ['municipality_id', 'name', 'address', 'email', 'site', 'phone'];

    public function calculateIndex($pathId) {
        // take all schools data
        $temp_data = [];
        $municipalities = Municipality::query()->get();
        foreach ($municipalities as $municipality) {
            $schools = self::query()
                ->where('municipality_id', $municipality['id'])
                ->count();

            $population = Population::query()->where('municipality_id', $municipality['id'])
                ->where('year', 2021)
                ->first();

            $temp_data[$municipality['path_id']] = number_format($schools/(($population['men']+$population['women'])/$municipality['density']),5);
        }

        $temp_data = collect($temp_data);
        $highestIndex = $temp_data->sortDesc()->first();
        $currentIndex = $temp_data[$pathId];

        // Find the index
        $finalIndex = ($currentIndex/$highestIndex) * 5;

        return number_format($finalIndex,2);
    }

    public function municipality(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_id', 'id');
    }
}
