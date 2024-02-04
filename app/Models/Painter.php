<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Painter extends Model
{
    protected $table = 'painters';

    public function paintings()
    {
        return $this->hasMany(Painting::class,'painter_id');
    }
}
