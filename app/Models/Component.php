<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'component';
    protected $fillable = ['product_id', 'qty', 'measure_id', 'description'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }


}
