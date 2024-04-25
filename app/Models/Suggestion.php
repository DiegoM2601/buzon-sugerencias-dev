<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subarea()
    {
        return $this->belongsTo(Sub_area::class, "subarea_id");
    }

    public function area()
    {
        return $this->belongsTo(Area::class, "area_id");
    }
}
