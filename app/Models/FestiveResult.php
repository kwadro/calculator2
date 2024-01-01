<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FestiveResult extends Model
{
    protected $fillable = ['name','festive_id','user_id','total','summa','price','image','cat_url','product_url','qty','measure'];
    protected $table = 'festive_result';

}
