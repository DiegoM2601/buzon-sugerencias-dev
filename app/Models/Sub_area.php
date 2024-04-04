<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_area extends Model
{
    use HasFactory;

    public function suggestions()
    {
        return $this->hasMany(Suggestion::class, "subarea_id");
    }
}