<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Samuser extends Model
{
    protected $table = 'sam_user';
    public function profile()
    {
        return $this->hasOne(Profiles::class);
    }
}
