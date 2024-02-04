<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fectiverecipe extends Model
{
    protected $table = 'fectiverecipe';
    protected $fillable = ['qty','festive_id','recipe_id'];
    public function festive()
    {
        return $this->belongsTo(Festive::class,'festive_id');
    }
}
