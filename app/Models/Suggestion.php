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

    //TODO: Arreglar el nombre de este método para obedecer la convención de Laravel
    public function objeto_area()
    {
        return $this->belongsTo(Area::class, "area_id");
    }
}