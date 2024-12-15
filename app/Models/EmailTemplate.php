<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model 
{ 
    protected $primaryKey = 'email_template_id';
    public $timestamps = false;

    protected $table = 'email_templates';

   
}
