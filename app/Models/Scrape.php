<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Scrape extends Model 
{ 
    protected $primaryKey = 'scrape_id';
    public $timestamps = false;

    protected $table = 'scrape_data';

   
}
