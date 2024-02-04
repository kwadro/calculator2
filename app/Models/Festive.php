<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Festive extends Model
{
    protected $table = 'festive';
    public function recipes()
    {
        return $this->hasMany(Fectiverecipe::class,'festive_id');
    }
}
