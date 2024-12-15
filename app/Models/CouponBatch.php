<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CouponBatch extends Model 
{ 
    protected $primaryKey = 'coupon_batch_id';
    public $timestamps = false;

    protected $table = 'coupon_batch';

   
}
