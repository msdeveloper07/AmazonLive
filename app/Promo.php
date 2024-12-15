<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Promo extends Model 
{ 
    protected $primaryKey = 'promo_id';
    public $timestamps = false;

    protected $table = 'promos';

   
}
