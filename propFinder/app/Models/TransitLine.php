<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitLine extends Model
{
    use HasFactory;
    protected $table = 'transit_lines';
    protected $fillable = ['municipality_id', 'municipality_code', 'transit_lines'];
}
