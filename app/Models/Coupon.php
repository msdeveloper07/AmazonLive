<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Coupon extends Model 
{ 
    protected $primaryKey = 'coupon_id';
    public $timestamps = false;

    protected $table = 'coupon';

   
}
