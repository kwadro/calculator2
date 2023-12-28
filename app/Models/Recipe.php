<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'recipe';
    public function components()
    {
        return $this->hasMany(Component::class,'recipe_id');
    }
}
