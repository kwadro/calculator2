<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    protected $table = 'profiles';
    public function samuser()
    {
        return $this->belongsTo(Samuser::class);
    }
}
