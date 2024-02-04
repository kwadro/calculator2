<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Painting extends Model
{
    protected $table = 'paintings';
    protected $fillable = ['title','body'];
    public function painter()
    {
        return $this->belongsTo(Painter::class,'painter_id');
    }
}
